<?php

namespace Model;

use Core\Model;
use Core\SqlQuery;

class NoticeModel extends Model {

    public function __construct() {
        
        parent::__construct();
        $this->table = 'notices';
    }

}

