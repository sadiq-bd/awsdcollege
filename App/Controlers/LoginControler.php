<?php

namespace Controler;

use \Core\Controler;
use Core\Session;

class LoginControler extends Controler {

    private $allowedTypes = array();

    public function __construct() {
        parent::__construct();

        $this->allowedTypes =  array(
            'student',
            'teacher',
            'admin'
        );
    }

    public function main($loginType) {
        $loginType = strtolower($loginType['type']);

        $optionModel = $this->load->model('OptionModel');
        $siteOptions = $optionModel->getAllOptions();

        
        $this->load->view('inc/header', array(
            'pageTabTitle' => 'Login - ' . $loginType,
            'siteOptions' => $siteOptions
        ));
        
        if (in_array($loginType, $this->allowedTypes)) {
            $this->load->view('login', array(
                'loginType' => $loginType
            ));
        } else {
            $this->load->view('errors/error');
        }
        
        $this->load->view('inc/footer', array(
            'siteOptions' => $siteOptions
        ));

    }


    public function loginAdmin() {
        
        $postData = postDataRetrieve();

        if (!$this->isValidCredentials($postData)) {
            return false; 
        }

        $adminModel = $this->load->model('AdminModel');
        if ($adminData = @$adminModel->getBy('admin_unique_id', $postData['username'])[0]) {
            if ($this->checkPasswordHash($postData['password'], $adminData['admin_password'])) {
                
                Session::set('admin', [
                    'id' => $adminData['ID'],
                    'uid' => $adminData['admin_unique_id']
                ]);
                
                sendJson(array(
                    'status' => 'success',
                    'statusCode' => 200,
                    'loadPage' => CONFIG['base_url'] . '/admin/dashboard',
                    'message' => 'Logged In Successfully'
                ));
                return true;
            } else {
                // incorrect pass
            }
        }

        
        sendJson(array(
            'status' => 'unauthorized',
            'statusCode' => 401,
            'message' => 'Invalid Login Credentials'
        ));
    
    }


    public function loginUser($param) {

        $type = strtolower($param['type']);

        switch ($type) {
            case 'student':
                $userModel = $this->load->model('StudentModel');
                break;
            case 'teacher':
                $userModel = $this->load->model('TeacherModel');
                break;
            case 'admin':
                $this->loginAdmin();
                return;
            default:
                return sendJson(array(
                    'status' => 'Forbidden',
                    'statusCode' => 403,
                    'message' => 'Invalid Login Type'
                ));
        }
        

        $postData = postDataRetrieve();

        if (!$this->isValidCredentials($postData)) {
            return false; 
        }

        if ($userData = @$userModel->getBy($type . '_unique_id', $postData['username'])[0]) {
            
            if ($this->checkPasswordHash($postData['password'], $userData[$postData['loginType'] . '_password'])) {
                            
                Session::set('user', [
                    'id' => $userData['ID'],
                    'uid' => $userData[$type . '_unique_id'],
                    'type' => $type
                ]);
                

                sendJson(array(
                    'status' => 'success',
                    'statusCode' => 200,
                    'loadPage' => CONFIG['base_url'] . '/dashboard',
                    'message' => 'Logged In Successfully'
                ));
                return true;
            } else {
                // incorrect login attempt

            }
            
        }
        
        sendJson(array(
            'status' => 'unauthorized',
            'statusCode' => 401,
            'message' => 'Invalid Login Credentials'
        ));
    
        
    }

    public function isValidCredentials($postData) {

        if ($postData['username'] == '' ||
         $postData['password'] == '' || 
         $postData['loginType'] == ''
         ) {
            sendJson(array(
                'status' => 'failed',
                'statusCode' => 403,
                'message' => 'Empty Fields Found'
            ));
            return false;
        }
        
        
        $minPassLength = 8;

        if (strlen($postData['password']) < $minPassLength) {
            sendJson(array(
                'status' => 'failed',
                'statusCode' => 403,
                'message' => 'Password length is less than ' . $minPassLength . ' characters'
            ));
            return false;
        }

        return true;

    }

    public function logoutUser($param) {
        if (isset($param['token'])) {
            if (Session::get('user') !== null) {
                $user = Session::get('user');
                Session::unset('user');
                session_regenerate_id();
                header('Location: ' . CONFIG['base_url']. '/login/' . $user['type']);
                
            }

            if (Session::get('admin') !== null) {
                $admin = Session::get('admin');
                Session::unset('admin');
                session_regenerate_id();
                header('Location: ' . CONFIG['base_url']. '/login/admin');
            }

        }
        exit;

    }


    private function checkPasswordHash(string $pwd, string $hash) {
        return password_verify($pwd, $hash);
    }

    private function getPasswordHash(string $pwd) {
        return password_hash($pwd, PASSWORD_DEFAULT);
    }


}

