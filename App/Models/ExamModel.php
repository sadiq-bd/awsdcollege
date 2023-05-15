<?php

namespace Model;
use \Core\Model;
use Core\SqlQuery;

class ExamModel extends Model {


    public function __construct() {
        
        $this->table = 'exams';
        
        parent::__construct();
    }


    public function getExamDataList (string $cond = null, array $condData = [], string $sortBy = 'ID', int $sort = 0, int $limit = 0, int $offset = 0) {

        $sql = new SqlQuery($this->db);
        $sql->select([
            'exams.*',
            'classes.class_name',
            'groups.group_title'
            ])
            ->from($this->table)
            ->join('classes', 'classes.ID = exams.exam_class_id', 'left')
            ->join('groups', 'groups.ID = exams.exam_group_id', 'left');

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


    public function getResultingList(int $examId, int $subId, $extraCond = '') {
        $table = 'exam_subject_results';
        $sql = new SqlQuery($this->db);
        $sql->setQuery(<<<QUERY
            SELECT
                exam_subject_results.ID,
                exam_subject_results.exam_id,
                exam_subject_results.exam_student_id,
                exam_subject_results.exam_subject_id,
                exam_subject_results.student_cq_mark,
                exam_subject_results.student_mcq_mark,
                exam_subject_results.student_practical_mark,
                exam_subject_results.result_total_mark,
                exam_subject_results.result_grade_letter,
                exam_subject_results.result_grade_point,
                exam_subject_results.result_is_passed,
                exam_subject_results.result_modified_at,
                students.ID AS studentId,
                students.student_unique_id,
                students.student_full_name,
                students.student_father_name,
                students.student_mother_name,
                students.student_roll
            FROM
                exams
            RIGHT JOIN classes ON exams.exam_class_id = classes.ID
            JOIN students ON classes.ID = students.student_class
            LEFT JOIN exam_subject_results ON (
                students.ID = exam_subject_results.exam_student_id
                AND exam_subject_results.exam_subject_id = {$subId}
            )
            WHERE
                exams.ID = {$examId}
                {$extraCond}
            
            ORDER BY
                student_roll ASC
                

        QUERY);

        if ($sql->exec()) {
            return $sql->fetchAll();
        } else {
            die($sql->getErrorInfo());
            return [];
        }
    }


    public function examSubjectResultInsertMultiple(array $data) {
        $table = 'exam_subject_results';
        $sql = new SqlQuery($this->db);
        $sql->setQuery('INSERT INTO ' . $table . ' (
            exam_id, 
            exam_student_id,
            exam_subject_id,
            student_cq_mark,
            student_mcq_mark,
            student_practical_mark,
            result_total_mark,
            result_grade_letter,
            result_grade_point,
            result_is_passed,
            result_modified_at
            ) 
        VALUES (
            :exam_id, 
            :exam_student_id, 
            :exam_subject_id, 
            :student_cq_mark, 
            :student_mcq_mark, 
            :student_practical_mark, 
            :result_total_mark, 
            :result_grade_letter, 
            :result_grade_point, 
            :result_is_passed,
            :result_modified_at
            )');
        foreach ($data as $key => $value) {
            if (!$sql->exec($value))
                die($sql->getErrorInfo());
        }
        return true;
    }


    public function examSubjectResultUpdateMultiple(array $data) {
        $table = 'exam_subject_results';
        $sql = new SqlQuery($this->db);
        $sql->setQuery('UPDATE ' . $table . ' SET 
            student_cq_mark = :student_cq_mark, 
            student_mcq_mark = :student_mcq_mark, 
            student_practical_mark = :student_practical_mark, 
            result_total_mark = :result_total_mark, 
            result_grade_letter = :result_grade_letter, 
            result_grade_point = :result_grade_point, 
            result_is_passed = :result_is_passed,
            result_modified_at = :result_modified_at
        WHERE 
            exam_student_id = :exam_student_id 
            AND exam_id = :exam_id 
            AND exam_subject_id = :exam_subject_id');
        foreach ($data as $key => $value) {
            if (!$sql->exec($value))
                return false;
        }
        return true;
    }

}

