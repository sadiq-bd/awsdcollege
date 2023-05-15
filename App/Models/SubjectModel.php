<?php

namespace Model;
use \Core\Model;
use Core\SqlQuery;

class SubjectModel extends Model {


    public function __construct() {
        
        $this->table = 'subjects';

        parent::__construct();
    }

    public function getSubjectList() {
        return $this->getList(null, [], 'ID', 0);
    }


    public function getSubjectBy(string $by, $data) {

        return $this->getBy($by, $data, 'subject_title', 0);
    }

    
    // public function getListWithIdIndexed() {
    //     $list = $this->getSubjectList();
    //     $idIndexedList = array();
    //     foreach ($list as $key => $value) {
    //         $idIndexedList[$value['ID']] = $value;
    //     }
    //     return $idIndexedList;
    // }

    public function getSelectedSubjects(int $studentId, string $sortBy = 'ID', int $sort = 0) {

        $table1 = $this->table;
        $table2 = 'selected_subjects';

        $sql = new SqlQuery($this->db);

        $sql->select([
                $table2 . '.*',
                $table1 . '.*'
            ])
            ->from($table1)
            ->join($table2, $table2 . '.selected_subject_id = ' . $table1 . '.ID', 'right')
            ->where('student_id = :sid', ['sid'=>$studentId])
            ->orderBy($table2 . '.' . $sortBy, $sort);

        if ($sql->exec()) {
            return $sql->fetchAll();
        }
    }



    public function addSelectedSubjects(int $studentId, array $subjectIds) {
        $table = 'selected_subjects';

        $sql = new SqlQuery($this->db);
        $sql->setQuery('INSERT INTO ' . $table . ' (student_id,selected_subject_id,selected_subject_is_optional,selected_subject_is_4th ) VALUES (:std, :sub, :isOpt, :is4th)');

        foreach ($subjectIds as $key => $value) {
            $data = [
                'std' => $studentId,
                'sub' => $value,
                'isOpt' => 1,
                'is4th' => 0,
            ];
            if ($key === count($subjectIds) - 1) {
                $data['isOpt'] = 0;
                $data['is4th'] = 1;
            }
            if (!$sql->exec($data)) {
                return sendJsonError('Unable to add subject', 501);
            }
        }
        return true;
    }


}

