<?php

namespace Model;

use Core\Model;
use Core\SqlQuery;

class ClassModel extends Model {

    public function __construct() {
        
        parent::__construct();
        $this->table = 'classes';
    }

    public function getClassBy(string $by, $data) {

        return $this->getBy($by, $data, 'class_name', 0);
    }

    public function getClassList(bool $only_admission_open = false) {
        if ($only_admission_open) {
            return $this->getList('class_admission_status = \'1\'', [], 'class_name', 0);
        } else {
            return $this->getList(null, [], 'class_name', 0);
        }
    }

    public function getListWithIdIndexed() {
        $list = $this->getClassList();
        $idIndexedList = array();
        foreach ($list as $key => $value) {
            $idIndexedList[$value['ID']] = $value;
        }
        return $idIndexedList;
    }

}

