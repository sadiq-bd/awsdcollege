<?php

namespace Model;
use \Core\Model;

class AdminModel extends Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'admins';
    }


}

