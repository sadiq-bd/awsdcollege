<?php

namespace Controler;

use \Core\Controler;
use Core\Session;
use \Controler\LoginControler;

class StudentControler extends Controler {

    public function __construct(bool $sessionCheck = true) {
        parent::__construct();

        if ($sessionCheck) {
            Session::init();

            if (Session::get('user') == null) {
                $loginCtrl = new LoginControler;
                $loginCtrl->main(array(
                    'type' => 'student'
                ));
                exit;
            }
        }
    }

    public function main() {

    }

    public function dashboardView() {
        
        $this->load->view('inc/basic-header', array(
            'pageTabTitle' => 'Welcome'
        ));

        $this->load->view('inc/user-nav');
        
        $this->load->view('dashboard');
        
        $this->load->view('inc/basic-footer');

    }

    public function resultView() {
        
        $this->load->view('inc/basic-header', array(
            'pageTabTitle' => 'Welcome'
        ));
        
        $this->load->view('inc/user-nav');
        
        $this->load->view('result');
        
        $this->load->view('inc/basic-footer');

    }

    public function academicView() {
        
        $userType = Session::get('user')['type'];
        $userId = Session::get('user')['id'];

        $userData = $this->getUserData($userType, 'ID', $userId, [
            'class', 'shift', 'group', 'section'
        ]);

        $this->load->view('inc/basic-header', array(
            'pageTabTitle' => 'Welcome'
        ));
        
        $this->load->view('inc/user-nav');
        
        $this->load->view('academic', array(
            'userData' => $userData,
            'userType' => $userType
        ));
        
        $this->load->view('inc/basic-footer');

    }

    public function paymentView() {
        
        $this->load->view('inc/basic-header', array(
            'pageTabTitle' => 'Welcome'
        ));
        
        $this->load->view('inc/user-nav');
        
        $this->load->view('payment');
        
        $this->load->view('inc/basic-footer');

    }

    public function profileView() {
        
        $userType = Session::get('user')['type'];
        $userId = Session::get('user')['id'];

        $userData = $this->getUserData($userType, 'ID', $userId);

        $this->load->view('inc/basic-header', array(
            'pageTabTitle' => 'Welcome'
        ));
        
        $this->load->view('inc/user-nav');
        
        $this->load->view('profile', array(
            'userData' => $userData,
            'userType' => $userType
        ));
        
        $this->load->view('inc/basic-footer');

    }


    public function getUserData(string $userType, string $getBy, $data, array $requireAdditionalInfo = []) {
        
        $userData = array();

        switch ($userType) {
            case 'student':
                $userModel = $this->load->model('StudentModel');
                break;
            case 'teacher':
                $userModel = $this->load->model('TeacherModel');
                break;
            default:
                exit;
        }

        $userData = $userModel->getBy($getBy, $data);
        if (isset($userData[0])) {
            $userData = $userData[0];
        } else {
            return;
        }
        
        if ($userType == 'student') {

            if (array_search('class', $requireAdditionalInfo) !== null) {
                $classModel = $this->load->model('ClassModel');
                $userData['student_class'] = $classModel->getClassBy('ID', $userData['student_class'])[0];
            }

            if (array_search('group', $requireAdditionalInfo) !== null) {
                $groupModel = $this->load->model('GroupModel');
                $userData['student_group'] = $groupModel->getGroupBy('ID', $userData['student_group'])[0];
            }

            if (array_search('shift', $requireAdditionalInfo) !== null) {
                $shiftModel = $this->load->model('ShiftModel');
                $userData['student_shift'] = $shiftModel->getShiftBy('ID', $userData['student_shift'])[0];
            }
            if (array_search('section', $requireAdditionalInfo) !== null) {
                $sectionModel = $this->load->model('SectionModel');
                $userData['student_section'] = @$sectionModel->getSectionBy('ID', $userData['student_section'])[0];
            }
        }
        
        $userData[$userType . '_photo'] = CONFIG['base_url'] . '/resources/images/'.$userType.'/' . $userData[$userType . '_photo'];
  
        return $userData;
    }




}

