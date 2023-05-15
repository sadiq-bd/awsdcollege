<?php

namespace Model;
use \Core\Model;
use Core\SqlQuery;

class ShiftModel extends Model {


    public function __construct() {
        
        $this->table = 'shifts';
        
        parent::__construct();
    }

    public function getShiftList() {
        return $this->getList(null, [], 'ID', 0);
    }


    public function getShiftBy(string $by, $data) {

        return $this->getBy($by, $data, 'shift_title', 0);
    }

    
    public function getListWithIdIndexed() {
        $list = $this->getShiftList();
        $idIndexedList = array();
        foreach ($list as $key => $value) {
            $idIndexedList[$value['ID']] = $value;
        }
        return $idIndexedList;
    }


}

