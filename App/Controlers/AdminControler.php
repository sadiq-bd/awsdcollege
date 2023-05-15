<?php

namespace Controler;
use \Core\Controler;
use Core\Session;

class AdminControler extends Controler {

    public function __construct() {
        parent::__construct();

        if (Session::get('admin') == null) {
            $loginCtrl = new LoginControler;
            $loginCtrl->main(array(
                'type' => 'admin'
            ));
            exit;
        }
    }

    public function main() {

        $this->dashboardView();

    }

    public function dashboardView() {

        $studentModel = $this->load->model('StudentModel');
        $approvedStudentCount = $studentModel->totalRowCount('student_approved_at IS NOT NULL');
        $unApprovedStudentCount = $studentModel->totalRowCount('student_approved_at IS NULL');

        $teacherModel = $this->load->model('TeacherModel');
        $teacherCount = $teacherModel->totalRowCount();

        $this->load->view('inc/basic-header');
        $this->load->view('admin/inc/admin-nav');
        $this->load->view('admin/dashboard', array(
            'approvedStudentCount' => $approvedStudentCount,
            'unApprovedStudentCount' => $unApprovedStudentCount,
            'teacherCount' => $teacherCount
        ));
        $this->load->view('inc/basic-footer');
    }

    public function manageStudentsView() {
        $this->load->view('inc/basic-header');
        $this->load->view('admin/inc/admin-nav');
        $this->load->view('admin/manage-students');
        $this->load->view('inc/basic-footer');
    }


    public function manageTeachersView() {
        $this->load->view('inc/basic-header');
        $this->load->view('admin/inc/admin-nav');
        $this->load->view('admin/manage-teachers');
        $this->load->view('inc/basic-footer');
    }


    public function profileView() {

        $adminData = array();
        $adminData = $this->getAdminData('admin_unique_id', Session::get('admin')['uid']);

        $this->load->view('inc/basic-header');
        $this->load->view('admin/inc/admin-nav');
        $this->load->view('admin/profile', array(
            'adminData' => $adminData
        ));
        $this->load->view('inc/basic-footer');
    }


    public function settingsView() {
        $this->load->view('inc/basic-header');
        $this->load->view('admin/inc/admin-nav');
        $this->load->view('admin/settings');
        $this->load->view('inc/basic-footer');
    }

    
    public function operationsView() {
        $this->load->view('inc/basic-header');
        $this->load->view('admin/inc/admin-nav');
        $this->load->view('admin/operations');
        $this->load->view('inc/basic-footer');
    }

    
    public function reportView() {
        $this->load->view('inc/basic-header');
        $this->load->view('admin/inc/admin-nav');
        $this->load->view('admin/report');
        $this->load->view('inc/basic-footer');
    }


    public function getAdminData(string $getBy, $data) {
        
        $adminData = array();
        $adminModel = $this->load->model('AdminModel');
        $adminData = $adminModel->getBy($getBy, $data);

        if (isset($adminData[0])) {
            $adminData = $adminData[0];
        }

        
        $adminData['admin_photo'] = CONFIG['base_url'] . '/resources/images/admin/' . $adminData['admin_photo'];
  
        return $adminData;
    }



}

