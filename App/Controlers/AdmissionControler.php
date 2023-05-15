<?php

namespace Controler;

use \Core\Controler;

class AdmissionControler extends Controler {

    private $type = 'students';


    public function __construct() {
        parent::__construct();

    }

    public function main() {
        $classes = $this->getAllClasses();
        $shifts = $this->getAllShifts();
        $groups = $this->getAllGroups();
        $sections = $this->getAllSections();

        $optionModel = $this->load->model('OptionModel');
        $siteOptions = $optionModel->getAllOptions();

        
        $this->load->view('inc/header', array(
            'pageTabTitle' => 'Addmission',
            'siteOptions' => $siteOptions
        ));
        if (count($classes) > 0) {
            $this->load->view('admission', array(
                'classes' => $classes,
                'shifts' => $shifts,
                'groups' => $groups,
                'sections' => $sections
            ));
        } else {
            echo '<center><h4>Current session admission date has over. Yet no admission circular.</h4></center>';
        }
        $this->load->view('inc/footer', array(
            'siteOptions' => $siteOptions
        ));

    }

    public function getAllClasses() {
        $classModel = $this->load->model('ClassModel');
        return $classModel->getList(true);
    }

    public function getAllShifts() {
        $ShiftModel = $this->load->model('ShiftModel');
        return $ShiftModel->getList();
    }

    
    public function getAllGroups() {
        $ShiftModel = $this->load->model('GroupModel');
        return $ShiftModel->getList();
    }

    public function getAllSections() {
        $ShiftModel = $this->load->model('SectionModel');
        return $ShiftModel->getList();
    }

    
    public function admitStudent() {
        $postData = postDataRetrieve();

        // TODO
        // POST data Validation


        $stdModel = $this->load->model('StudentModel');

        if ($stdModel->add($this->type, $postData)) {

        }

    }


    public function getSelectableSubjects() {
        
        $postData = postDataRetrieve();

        if (empty($postData['classId']) || empty($postData['groupId'])) {
            return sendJsonError('Class, Group Missing', 403);
        } else {
            $subjectModel = $this->load->model('subjectModel');
            $subjects = $subjectModel->getList(
                '(subject_class_id = :cid OR subject_class_id = 0) AND (subject_group_id = :gid OR subject_group_id = 0)',
                ['cid'=> $postData['classId'], 'gid' => $postData['groupId']],
                'ID',
                0
            );

            if (@count($subjects) > 0) {
                return sendJsonSuccess(json_encode($subjects));
            } else {
                return sendJsonError('No Subject Found');
            }
        }
    }


    public function registerStudent() {
        
        $postData = postDataRetrieve();

        if (empty($postData['authToken'])) {

            return sendJsonError('Auth token not found', 401);

        } else {

            $token = $postData['authToken'];

        }


        // validation
        $notRequired = ['studentEmailInput'];
        foreach ($postData as $stdKey => $stdData) {
            if (empty($stdData) || $stdData == 0) {
                if (!in_array($stdKey, $notRequired)) {
                    return sendJsonError('\'' . $stdKey . '\' is empty', 403);
                }
            }
        }

        // mobile 
        if (!preg_match('/^\d{10}$/', @$postData['studentMobileInput'])) {

            return sendJsonError('Invalid mobile no', 403);
            
        }
        // email 
        if (!@filter_var(@$postData['studentEmailInput'], FILTER_VALIDATE_EMAIL) && !empty($postData['studentEmailInput'])) {

            return sendJsonError('Invalid email address', 403);

        }

        
        $student_photo = '';
        $studentImage = @$postData['studentPicture'];
            
        $uploadDir = APP_ROOT .'/' . trim(CONFIG['dirs']['images']['students'], '/');

        $uploadName = @$postData['studentID'] . '_' . uniqid();

        if (!rawFileUpload([
            'name' => $studentImage['name'],
            'file-data' => $studentImage['data'],
            'max-file-size' => 1,
            'upload-name' => $uploadName,
            'upload-dir' => $uploadDir,
            'valid-extensions' => ['jpg', 'jpeg', 'png']
        ], function ($file) use (&$student_photo, $postData, $uploadDir) {

            // set new
            $student_photo = $file;

            // delete previous picture
            if (!empty($postData['previousPicture'])) {
                if (is_file($uploadDir . '/' . $postData['previousPicture'])) {
                    unlink($uploadDir . '/' . $postData['previousPicture']);
                }
            }

        }, function ($err, $msg) {
            return sendJsonError($msg, 403);
        })) return;



        $password = @$postData['studentPasswordInput'];
        $pwdRegex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,30}$/';
        if (!preg_match($pwdRegex, $password)) {
            return sendJsonError('Password is too week. Try to strong it', 403);
        }
        $hashPwd = password_hash($password, PASSWORD_DEFAULT);


        $studentData = array(
            'student_unique_id' => abs( crc32( uniqid() ) ),
            'student_password' => $hashPwd,
            'student_full_name' => @$postData['studentNameInput'],
            'student_father_name' => @$postData['studentFatherNameInput'],
            'student_father_nid' => @$postData['studentFatherNidInput'],
            'student_mother_name' => @$postData['studentMotherNameInput'],
            'student_mother_nid' => @$postData['studentMotherNidInput'],
            'student_class' => @$postData['admissionClassSelectId'],
            'student_session' => @$postData['admissionSessionSelect'],
            'student_group' => @$postData['studentGroupSelect'],
            'student_roll' => '0',
            'student_section' => '0',                                           // TODO
            'student_shift' => @$postData['studentShiftSelect'],
            'student_gender' => @$postData['studentGenderSelect'],
            'student_religion' => @$postData['studentReligionSelect'],
            'student_nationality' => @$postData['studentNationalitySelect'],
            'student_blood_group' => @$postData['studentBloodSelect'],
            'student_birth_date' => @$postData['studentBirthInput'],
            'student_photo' => $student_photo,
            'student_mobile_no' => @$postData['studentMobileInput'],
            'student_email' => @$postData['studentEmailInput'],
            'student_division' => @$postData['studentDivisionSelect'],
            'student_district' => @$postData['studentZillaSelect'],
            'student_subdistrict' => @$postData['studentUpozillaInput'],
            'student_address' => json_encode(array(
                'postOffice' => @$postData['studentPostOfficeInput'],
                'village' => @$postData['studentVillageInput']
            )),
            'student_meta' => '',
            'student_admitted_at' => timestamp()
        );


        $stdModel = $this->load->model('StudentModel');

        if ($stdModel->insert($studentData)) {
   
            $studentId = $stdModel->getSql()->lastInsertId();
        
            // selected subjects
            if (is_array(@$postData['studentSelectedSubjects'])) {
                $subjectModel = $this->load->model('SubjectModel');
                if (!$subjectModel->addSelectedSubjects($studentId, $postData['studentSelectedSubjects'])) {
                    return sendJsonError('unable to add subjects', 501);
                }
            }


            return sendJson([
                'message' => 'Admission form submited succesfully',
                'status' => 'success',
                'statusCode' => 200,
                'loadPage' => CONFIG['base_url'] . '/sms-verification'
            ]);

        } else {
            
            return sendJsonError('Error: ' . $stdModel->error, 500);

        }


    }


    function smsVerification() {
        echo 'SMS OTP verification not configured yet';
    }

}

