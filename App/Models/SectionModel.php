<?php

namespace Model;
use \Core\Model;
use Core\SqlQuery;

class SectionModel extends Model {


    public function __construct() {
        
        $this->table = 'sections';
        
        parent::__construct();
    }

    public function getSectionList() {
        return $this->getList(null, [], 'ID', 0);
    }


    public function getSectionBy(string $by, $data) {

        return $this->getBy($by, $data, 'section_title', 0);
    }

    
    public function getListWithIdIndexed() {
        $list = $this->getSectionList();
        $idIndexedList = array();
        foreach ($list as $key => $value) {
            $idIndexedList[$value['ID']] = $value;
        }
        return $idIndexedList;
    }

}

