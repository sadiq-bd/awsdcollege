<?php

namespace Controler;

use \Core\Controler;

class ErrorPageControler extends Controler {

    public function __construct() {
        parent::__construct();
    } 

    public function main() {
        if (http_response_code() == 200) {
            $errCode = 404;
        } else {
            $errCode = (int)http_response_code();
        }

        $err = array();
        $err['errCode'] = $errCode;
        $err['errMsg'] = $this->getErrorMessage($errCode);

        // header
        header('HTTP/1.1 ' . $err['errCode'] . ' ' . $err['errMsg']);
        
        $this->errorView($err);

    }

    public function errorView(array $errInfo) {
        $optionModel = $this->load->model('OptionModel');
        $siteOptions = $optionModel->getAllOptions();

        
        $this->load->view('inc/header', array(
            'pageTabTitle' => $errInfo['errCode'] . ' ' . $errInfo['errMsg'],
            'siteOptions' => $siteOptions
        ));

        $this->load->view('errors/error', $errInfo);
        $this->load->view('inc/footer', array(
            'siteOptions' => $siteOptions
        ));
    }

    public function getErrorMessage(int $errCode) { 
        $errMessages = array(
            400 => 'Bad Request',
            401 => 'Unauthorized',
            403 => 'Forbidden',
            404 => 'Not Found'
        );
        return isset($errMessages[$errCode]) ? $errMessages[$errCode] : '';
    }

    public function noscript() {
        $this->load->view('errors/noscript');
    }

}

