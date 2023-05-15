<?php

namespace Model;
use \Core\Model;

class OptionModel extends Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'options';
    }

    public function getAllOptions() {
        $options = $this->getList();
        $finalOptions = array();
        foreach ($options as $opt) {
            $finalOptions[$opt['option_name']] = $opt['option_value'];
        }
        return $finalOptions;
    }


}

