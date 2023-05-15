<?php

namespace Model;
use \Core\Model;
use \Core\SqlQuery;

class StudentModel extends Model {

    public function __construct() {

        $this->table = 'students';
        
        parent::__construct();

    }

    public function getStudentDataList (string $cond = null, array $condData = [], string $sortBy = 'ID', int $sort = 0, int $limit = 0, int $offset = 0) {

        $sql = new SqlQuery($this->db);
        $sql->select([
            'students.*',
            'classes.class_name',
            'groups.group_title',
            'shifts.shift_title',
            'sections.section_title'
            ])
            ->from($this->table)
            ->join('classes', 'classes.ID = students.student_class', 'left')
            ->join('groups', 'groups.ID = students.student_group', 'left')
            ->join('shifts', 'shifts.ID = students.student_shift', 'left')
            ->join('sections', 'sections.ID = students.student_section', 'left');

        if ($cond !== null) {
            $sql->where($cond, $condData);
        }

        $sql->orderby($sortBy, $sort);

        if ($limit > 0) {
            $sql->limit($limit, $offset);
        }

        if ($result = $sql->exec()) {
            return $result->fetchAll();
        }
    }

}

