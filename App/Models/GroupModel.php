<?php

namespace Model;
use \Core\Model;
use Core\SqlQuery;

class GroupModel extends Model {


    public function __construct() {

        $this->table = 'groups';

        parent::__construct();
    }

    public function getGroupList() {
        return $this->getList(null, [], 'ID', 0);
    }


    public function getGroupBy(string $by, $data) {

        return $this->getBy($by, $data, 'group_title', 0);
    }

    
    public function getListWithIdIndexed() {
        $list = $this->getGroupList();
        $idIndexedList = array();
        foreach ($list as $key => $value) {
            $idIndexedList[$value['ID']] = $value;
        }
        return $idIndexedList;
    }

}

