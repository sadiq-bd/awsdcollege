<?php

namespace Controler;

use \Controler\AdminControler;


class StudentManagement extends AdminControler {

    public function __construct() {
        parent::__construct();
    }

    public function approvalView() {

        $cond = 'student_approved_at IS NULL';
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

        
        $studentListFilterHandler = $this->studentListFilterHandler($cond);
        $cond = $studentListFilterHandler['cond'];
        $data = $studentListFilterHandler['data'];
        

        $studentModel = $this->load->model('StudentModel');
        $studentData = $studentModel->getStudentDataList($cond, $data, 'students.ID', $sort, $limit, $offset);


        $totalStudentCount = $this->getTotalStudentCount('student_approved_at IS NULL');
        $totalPageCount = ceil($totalStudentCount / $limit);

        $serialNumberDown = $totalStudentCount - $offset;

        $this->load->view('inc/basic-header');
        $this->load->view('admin/inc/admin-nav');
        $this->load->view('admin/manage-students/approval', array(
            'studentData' => $studentData,
            'totalStudentCount' => $totalStudentCount,
            'totalPageCount' => $totalPageCount,
            'serialNumber' => $serialNumberDown
        ));
        $this->load->view('inc/basic-footer');


    }


    public function approvalAction() {
        $action = @$_POST['action'];
        $studentID = @$_POST['studentID'];
        if (!empty($studentID)) {
            switch($action) {
                case 'approve':
                    $studentModel = $this->load->model('StudentModel');
                    if (!$studentModel->update('ID = :condId' , [
                        'condId' => $studentID
                    ], [
                        'student_approved_at' => timestamp()
                    ])) {
                        
                        return sendJsonError('Failed to Approve', 501);
                    }
            
                    break;
                case 'reject':
                    $studentModel = $this->load->model('StudentModel');
                    if (!$studentModel->delete('ID = ?', [$studentID])) {

                        return sendJsonError('Failed to Reject', 501);

                    }
                    break;
                default:
                    return sendJsonError('Invalid Action', 403);

            }
            header('Location: ' . CONFIG['base_url'] . '/admin/manage-students/approval');
        }
    }

    public function infoView() {

        if (isset($_POST['studentID'])) {

            $studentModel = $this->load->model('StudentModel');
            $studentData = $studentModel->getStudentDataList('students.ID = :id', [$_POST['studentID']])[0];

            $subjectModel = $this->load->model('SubjectModel');
            $selected_subjects = $subjectModel->getSelectedSubjects($studentData['ID']);

            $viewType = preg_match('#/approval/info#i',$_SERVER['REQUEST_URI']) ? 'approval' : 'manage';

            $this->load->view('inc/basic-header');
            $this->load->view('admin/inc/admin-nav');
            $this->load->view('admin/manage-students/info', array(
                'viewType' => $viewType,
                'studentData' => $studentData,
                'selected_subjects' => $selected_subjects
            ));
            $this->load->view('inc/basic-footer');
        }
    }

    public function editView() {

        if (isset($_POST['studentID'])) {

            $studentModel = $this->load->model('StudentModel');
            $studentData = $studentModel->getStudentDataList('students.ID = :id', [$_POST['studentID']])[0];

            $subjectModel = $this->load->model('SubjectModel');
            $selected_subjects = $subjectModel->getSelectedSubjects($studentData['ID']);

            $this->load->view('inc/basic-header');
            $this->load->view('admin/inc/admin-nav');
            $this->load->view('admin/manage-students/edit', array(
                'viewType' => 'approval',
                'studentData' => $studentData,
                'selected_subjects' => $selected_subjects,
                'academicInfo' => $this->getAcademicInfo()
            ));
            $this->load->view('inc/basic-footer');
        }

    }

    public function updateInfo() {

        
        $postData = postDataRetrieve();

        $studentData = array();

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
        if (!preg_match('/^\d{10}$/', @$postData['studentMobileInput'])) {

            return sendJsonError('Invalid mobile no', 403);
            
        }
        // email 
        if (!@filter_var(@$postData['studentEmailInput'], FILTER_VALIDATE_EMAIL)) {

            return sendJsonError('Invalid email address', 403);

        }

        if (!empty(@$postData['studentPicture'])) {

            $studentImage = $postData['studentPicture'];
            
            $uploadDir = APP_ROOT .'/' . trim(CONFIG['dirs']['images']['students'], '/');

            $uploadName = @$postData['studentID'] . '_' . uniqid();

            if (!rawFileUpload([
                'name' => $studentImage['name'],
                'file-data' => $studentImage['data'],
                'max-file-size' => 1,
                'upload-name' => $uploadName,
                'upload-dir' => $uploadDir,
                'valid-extensions' => ['jpg', 'jpeg', 'png']
            ], function ($file) use (&$studentData, $postData, $uploadDir) {

                // set new
                $studentData['student_photo'] = $file;

                // delete previous picture
                if (!empty($postData['previousPicture'])) {
                    if (is_file($uploadDir . '/' . $postData['previousPicture'])) {
                        unlink($uploadDir . '/' . $postData['previousPicture']);
                    }
                }

            }, function ($err, $msg) {
                return sendJsonError($msg, 403);
            })) return;



        }

        if (!empty(@$postData['studentPasswordInput'])) {

            $password = @$postData['studentPasswordInput'];
            $pwdRegex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,30}$/';
            if (!preg_match($pwdRegex, $password)) {
                return sendJsonError('Password is too week. Try to strong it', 403);
            }
            $hashPwd = password_hash($password, PASSWORD_DEFAULT);

            $studentData['student_password'] = $hashPwd;
        }

        $studentData = array_merge(array(
            'student_full_name' => @$postData['studentNameInput'],
            'student_father_name' => @$postData['studentFatherNameInput'],
            'student_father_nid' => @$postData['studentFatherNidInput'],
            'student_mother_name' => @$postData['studentMotherNameInput'],
            'student_mother_nid' => @$postData['studentMotherNidInput'],
            'student_class' => @$postData['admissionClassSelectId'],
            'student_session' => @$postData['admissionSessionSelect'],
            'student_group' => @$postData['studentGroupSelect'],
            'student_roll' => @$postData['studentRollInput'],
            'student_section' => @$postData['studentSectionSelect'],                                           // TODO
            'student_shift' => @$postData['studentShiftSelect'],
            'student_gender' => @$postData['studentGenderSelect'],
            'student_religion' => @$postData['studentReligionSelect'],
            'student_nationality' => @$postData['studentNationalitySelect'],
            'student_blood_group' => @$postData['studentBloodSelect'],
            'student_birth_date' => @$postData['studentBirthInput'],
            'student_mobile_no' => @$postData['studentMobileInput'],
            'student_email' => @$postData['studentEmailInput'],
            'student_division' => @$postData['studentDivisionSelect'],
            'student_district' => @$postData['studentZillaSelect'],
            'student_subdistrict' => @$postData['studentUpozillaInput'],
            'student_address' => json_encode(array(
                'postOffice' => @$postData['studentPostOfficeInput'],
                'village' => @$postData['studentVillageInput']
            )),
            'student_meta' => ''
        ), $studentData);

        


        $studentModel = $this->load->model('StudentModel');
        if ($studentModel->update('ID = :condId', [
            'condId' => $postData['studentID']
        ], $studentData)) {
            sendJsonSuccess('Data Updated Successfully');
        } else {
            sendJsonError('Failed to update Data', 501);
        }

        
    }

    public function manageView() {

        $cond = 'student_approved_at IS NOT NULL';
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
        
        $studentListFilterHandler = $this->studentListFilterHandler($cond);
        $cond = $studentListFilterHandler['cond'];
        $data = $studentListFilterHandler['data'];
        
        

        $studentModel = $this->load->model('StudentModel');
        $studentData = $studentModel->getStudentDataList($cond, $data, 'students.ID', $sort, $limit, $offset);


        $totalStudentCount = $this->getTotalStudentCount('student_approved_at IS NOT NULL');
        $totalPageCount = ceil($totalStudentCount / $limit);

        $serialNumberDown = $totalStudentCount - $offset;

        $this->load->view('inc/basic-header');
        $this->load->view('admin/inc/admin-nav');
        $this->load->view('admin/manage-students/manage', array(
            'studentData' => $studentData,
            'totalStudentCount' => $totalStudentCount,
            'totalPageCount' => $totalPageCount,
            'serialNumber' => $serialNumberDown
        ));
        $this->load->view('inc/basic-footer');
    }



    public function getTotalStudentCount($cond = null , $condData = []) {
        $studentModel = $this->load->model('StudentModel');
        return $studentModel->totalRowCount($cond, $condData);
    }

    public function getAcademicInfo(array $select = null) {

        $info = array();
        if ($select === null || in_array('classes', $select)) {
            $classModel = $this->load->model('ClassModel');
            $info['classes'] = $classModel->getList();
        }
        if ($select === null || in_array('groups', $select)) {
            $groupModel = $this->load->model('GroupModel');
            $info['groups'] = $groupModel->getList();
        }
        if ($select === null || in_array('shifts', $select)) {
            $shiftModel = $this->load->model('ShiftModel');
            $info['shifts'] = $shiftModel->getList();
        }
        if ($select === null || in_array('sections', $select)) {
            $sectionModel = $this->load->model('SectionModel');
            $info['sections'] = $sectionModel->getList();
        }
        return $info;
    }


    private function studentListFilterHandler(string $defaultCond = '') {
        $cond = $defaultCond;
        $data = [];
        if (!empty($_GET['search'])) {
            $q = $_GET['search'];
            
            if (!empty($_GET['filter'])) {
                switch($_GET['filter']) {
                    case 'student_class':
                        $academicInfo = $this->getAcademicInfo(['classes']);      
                        foreach ($academicInfo['classes'] as $class) {
                            if (preg_match('#' . $q . '#i', $class['class_name'])) {
                                $q = $class['ID'];
                                break;
                            }
                        }
                        break;
                    case 'student_group':
                        $academicInfo = $this->getAcademicInfo(['groups']);      
                        foreach ($academicInfo['groups'] as $group) {
                            if (preg_match('#' . $q . '#i', $group['group_title'])) {
                                $q = $group['ID'];
                                break;
                            }
                        }
                        break;
                }
                $cond = $_GET['filter'] . ' LIKE ?';
                $data = ['%' .$q . '%'];
            } else {
                $cond = <<<QUERY
                    student_unique_id LIKE :uid OR 
                    student_full_name LIKE :name OR
                    student_roll LIKE :roll 
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
        $admissionCtrl = new AdmissionControler;
        $classes = $admissionCtrl->getAllClasses();
        $shifts = $admissionCtrl->getAllShifts();
        $groups = $admissionCtrl->getAllGroups();
        $sections = $admissionCtrl->getAllSections();

        $this->load->view('inc/basic-header');
        $this->load->view('admin/inc/admin-nav');
        if (count($classes) > 0) {
            $this->load->view('admin/manage-students/register', array(
                'classes' => $classes,
                'shifts' => $shifts,
                'groups' => $groups,
                'sections' => $sections
            ));
        } else {
            echo '<center><h4>Current session admission date has over. Yet no admission circular.</h4></center>';
        }
        $this->load->view('inc/basic-footer');
    }

}

