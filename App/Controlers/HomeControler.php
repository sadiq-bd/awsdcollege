<?php

namespace Controler;

use \Core\Controler;

class HomeControler extends Controler {

    public function __construct() {
        parent::__construct();
    }

    public function main() {
        $optionModel = $this->load->model('OptionModel');
        $siteOptions = $optionModel->getAllOptions();

        $noticeModel = $this->load->model('NoticeModel');
        $notices = $noticeModel->getList(null, [], 'notice_date DESC, ID', 1, 8);

        
        $this->load->view('inc/header', array(
            'pageTabTitle' => 'Home',
            'siteOptions' => $siteOptions
        ));
        $this->load->view('home', array(
            'siteOptions' => $siteOptions,
            'notices' => $notices
        ));
        $this->load->view('inc/footer', array(
            'siteOptions' => $siteOptions
        ));
    }

}

