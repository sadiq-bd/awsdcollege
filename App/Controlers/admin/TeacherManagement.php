<?php

namespace Controler;

use \Controler\AdminControler;
use \Controler\UserControler;

class TeacherManagement extends AdminControler {

    public function __construct() {
        parent::__construct();
    }


    public function infoView() {

        if (isset($_POST['teacherID'])) {

            $teacherModel = $this->load->model('TeacherModel');
            $teacherData = $teacherModel->getList('teachers.ID = :id', [$_POST['teacherID']])[0];

            $this->load->view('inc/basic-header');
            $this->load->view('admin/inc/admin-nav');
            $this->load->view('admin/manage-teachers/info', array(
                'teacherData' => $teacherData
            ));
            $this->load->view('inc/basic-footer');
        }
    }

    public function editView() {

        if (isset($_POST['teacherID'])) {

            $teacherModel = $this->load->model('TeacherModel');
            $teacherData = $teacherModel->getTeacherDataList('teachers.ID = :id', [$_POST['teacherID']])[0];

            $this->load->view('inc/basic-header');
            $this->load->view('admin/inc/admin-nav');
            $this->load->view('admin/manage-teachers/edit', array(
                'teacherData' => $teacherData
            ));
            $this->load->view('inc/basic-footer');
        }

    }

    public function updateInfo() {

        
        $postData = postDataRetrieve();

        $teacherData = array();

        if (empty($postData['authToken'])) {

            return sendJsonError('Auth token not found', 401);

        } else {

            $token = $postData['authToken'];

        }


        // validation

        foreach ($postData as $stdKey => $stdData) {
            if (empty($stdData) || $stdData == 0) {

                return sendJsonError('\'' . $stdKey . '\' is empty', 403);
            }
        }

        // mobile 
        if (!preg_match('/^\d{10}$/', @$postData['teacherMobileInput'])) {

            return sendJsonError('Invalid mobile no', 403);
            
        }
        // email 
        if (!@filter_var(@$postData['teacherEmailInput'], FILTER_VALIDATE_EMAIL)) {

            return sendJsonError('Invalid email address', 403);

        }

        if (!empty(@$postData['teacherPicture'])) {

            $teacherImage = $postData['teacherPicture'];
            
            // image
            $imageExt = pathinfo(filter_var($teacherImage['name']), PATHINFO_EXTENSION);
            $validImageExtensions = ['jpg', 'jpeg', 'png'];
            $maxImageSize = 10; 
            if (in_array($imageExt, $validImageExtensions)) {
                $imageData = base64_decode($teacherImage['data']);
                if (strlen($imageData) < 1024 * 1024 * $maxImageSize) {    
                    $save_img_path = __DIR__ .'/../../' . trim(CONFIG['dirs']['images']['teachers'], '/');
                    if (isset($teacherImage['data'])) {
                        
                        $imageFile = @$postData['teacherID'] . '_' . uniqid() . '.' . $imageExt;
                        $imageFileWithDir = $save_img_path . '/' . $imageFile;

                        touch($imageFileWithDir);
                        file_put_contents($imageFileWithDir, $imageData);    
                        
                        $teacherData['teacher_photo'] = $imageFile;

                        // delete previous picture
                        if (!empty($postData['previousPicture'])) {
                            if (is_file($save_img_path . '/' . $postData['previousPicture'])) {
                                unlink($save_img_path . '/' . $postData['previousPicture']);
                            }
                        }
                                
                    }
                } else {
                    
                    return sendJsonError('Image file size exceed (max ' . $maxImageSize . 'MB)', 403);

                }
            } else {

                return sendJsonError('Invalid image file format', 403);

            }


        }

        if (!empty(@$postData['teacherPasswordInput'])) {

            $password = @$postData['teacherPasswordInput'];
            $pwdRegex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,30}$/';
            if (!preg_match($pwdRegex, $password)) {
                return sendJsonError('Password is too week. Try to strong it', 403);
            }
            $hashPwd = password_hash($password, PASSWORD_DEFAULT);

            $teacherData['teacher_password'] = $hashPwd;
        }

        $teacherData = array_merge(array(
            'teacher_full_name' => @$postData['teacherNameInput'],
            'teacher_father_name' => @$postData['teacherFatherNameInput'],
            'teacher_father_nid' => @$postData['teacherFatherNidInput'],
            'teacher_mother_name' => @$postData['teacherMotherNameInput'],
            'teacher_mother_nid' => @$postData['teacherMotherNidInput'],
            'teacher_class' => @$postData['admissionClassSelectId'],
            'teacher_session' => @$postData['admissionSessionSelect'],
            'teacher_group' => @$postData['teacherGroupSelect'],
            'teacher_roll' => @$postData['teacherRollInput'],
            'teacher_section' => @$postData['teacherSectionSelect'],                                           // TODO
            'teacher_shift' => @$postData['teacherShiftSelect'],
            'teacher_gender' => @$postData['teacherGenderSelect'],
            'teacher_religion' => @$postData['teacherReligionSelect'],
            'teacher_nationality' => @$postData['teacherNationalitySelect'],
            'teacher_blood_group' => @$postData['teacherBloodSelect'],
            'teacher_birth_date' => @$postData['teacherBirthInput'],
            'teacher_mobile_no' => @$postData['teacherMobileInput'],
            'teacher_email' => @$postData['teacherEmailInput'],
            'teacher_division' => @$postData['teacherDivisionSelect'],
            'teacher_district' => @$postData['teacherZillaSelect'],
            'teacher_subdistrict' => @$postData['teacherUpozillaInput'],
            'teacher_address' => json_encode(array(
                'postOffice' => @$postData['teacherPostOfficeInput'],
                'village' => @$postData['teacherVillageInput']
            )),
            'teacher_meta' => ''
        ), $teacherData);

        


        $teacherModel = $this->load->model('TeacherModel');
        if ($teacherModel->update('ID = :condId', [
            'condId' => $postData['teacherID']
        ], $teacherData)) {
            sendJsonSuccess('Data Updated Successfully');
        } else {
            sendJsonError('Failed to update Data', 501);
        }

        
    }

    public function manageView() {

        $cond = '';
        $data = [];
        $sort = 1;
        $limit = 10;
        $offset = 0;
        $page = 1;

        if (!empty($_GET['page'])) {
            if (filter_var($_GET['page'], FILTER_VALIDATE_INT)) {
                $page = $_GET['page'];
                $offset = $limit * ($page - 1);
            }
        }
        
        $teacherListFilterHandler = $this->teacherListFilterHandler($cond);
        $cond = $teacherListFilterHandler['cond'];
        $data = $teacherListFilterHandler['data'];
        
        

        $teacherModel = $this->load->model('TeacherModel');
        $teacherData = $teacherModel->getList($cond, $data, 'teachers.ID', $sort, $limit, $offset);


        $totalTeacherCount = $this->getTotalTeacherCount();
        $totalPageCount = ceil($totalTeacherCount / $limit);

        $serialNumberDown = $totalTeacherCount - $offset;

        $this->load->view('inc/basic-header');
        $this->load->view('admin/inc/admin-nav');
        $this->load->view('admin/manage-teachers/manage', array(
            'teacherData' => $teacherData,
            'totalTeacherCount' => $totalTeacherCount,
            'totalPageCount' => $totalPageCount,
            'serialNumber' => $serialNumberDown
        ));
        $this->load->view('inc/basic-footer');
    }



    public function getTotalTeacherCount($cond = null , $condData = []) {
        $teacherModel = $this->load->model('TeacherModel');
        return $teacherModel->totalRowCount($cond, $condData);
    }


    private function teacherListFilterHandler(string $defaultCond = '') {
        $cond = $defaultCond;
        $data = [];
        if (!empty($_GET['search'])) {
            $q = $_GET['search'];
            
            if (!empty($_GET['filter'])) {
                $cond = $_GET['filter'] . ' LIKE ?';
                $data = ['%' .$q . '%'];
            } else {
                $cond = <<<QUERY
                    teacher_unique_id LIKE :uid OR 
                    teacher_full_name LIKE :name
                QUERY;
                $data = [
                    'uid' => '%'.$q.'%','name' => '%'.$q.'%','roll' => '%'.$q.'%'
                ];
            }
            if ($defaultCond !== '' && $defaultCond !== null) {
                $cond = '(' . $cond . ') AND (' . $defaultCond . ')';
            }
            
        }
        return [
            'cond' => $cond,
            'data' => $data
        ];
    }

    public function registerView() {

        $this->load->view('inc/basic-header');
        $this->load->view('admin/inc/admin-nav');

        $this->load->view('admin/manage-teachers/register');

        $this->load->view('inc/basic-footer');
    }

}

