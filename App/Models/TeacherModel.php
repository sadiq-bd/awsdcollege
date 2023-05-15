<?php

namespace Model;
use \Core\Model;

class TeacherModel extends Model {

    public function __construct() {

        $this->table = 'teachers';
        
        parent::__construct();
    }


}

