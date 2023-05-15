<?php

namespace Controler;

use \Controler\AdminControler;


class OperationsControler extends AdminControler {

    private $siteOptions = array();
    
    public function __construct() {
        parent::__construct();

        $optionModel = $this->load->model('OptionModel');
        $this->siteOptions = $optionModel->getAllOptions();

    }


    public function examMarkView() {

        $resultingList = [];
        if (!empty($_GET['examSelect']) && !empty($_GET['subjectSelect'])) {
            $examModel = $this->load->model('ExamModel');
            $extaCond = '';
            if (isset($_GET['rollInput'])) {
                $roll = $_GET['rollInput'];
                if (filter_var($roll, FILTER_VALIDATE_INT)) {
                    $extaCond = 'AND students.student_roll = ' . $roll;
                } elseif (preg_match('/(\d+)\s*\-\s*(\d+)/i', $roll, $matches)) {
                    if ($matches[1] < $matches[2]) {
                        $extaCond = 'AND students.student_roll BETWEEN ' . $matches[1] . ' AND ' . $matches[2];
                    }
                }
            }
            $resultingList = $examModel->getResultingList($_GET['examSelect'], $_GET['subjectSelect'], $extaCond);
        }


        $exams = $this->load->model('ExamModel')->getExamDataList();

        $subjects = $this->load->model('SubjectModel')->getList();
        
        $this->load->view('inc/basic-header');
        $this->load->view('admin/inc/admin-nav');
        $this->load->view('admin/operations/exam_mark', array(
            'siteOptions' => $this->siteOptions,
            'exams' => $exams,
            'subjects' => $subjects,
            'resultingList' => $resultingList
        ));
        $this->load->view('inc/basic-footer');
    
    }


    public function examMarkEntry() {
        $examId = @$_GET['examId'];
        $subjectId = @$_GET['subjectId'];

        if (empty($examId) || empty($subjectId)) {
            return sendJsonError('Exam or Subject Id empty');
        }

        $results = postDataRetrieve();
        $adds = [];
        $edits = [];
        foreach ($results as $key => $value) {
            $total = 0;
            $marks = [];
            foreach ([
                'cq' => @$value['cq'], 
                'mcq' => @$value['mcq'], 
                'practical' => @$value['practical']
                ] as $k => $v) {
                if (filter_var($v, FILTER_VALIDATE_INT)) {
                    $marks[$k] = $v;
                    $total += $v;
                } else {
                    $marks[$k] = null;
                }
            }

            if ($total < 1 && $value['type'] == 'add') 
                continue;

            $row = [
                'exam_id' => $examId,
                'exam_student_id' => $value['studentId'],
                'exam_subject_id' => $subjectId,
                'student_cq_mark' => $marks['cq'],
                'student_mcq_mark' => $marks['mcq'],
                'student_practical_mark' => $marks['practical'],
                'result_total_mark' => $total,
                'result_grade_letter' => getGradeLetter($total),
                'result_grade_point' => getGradePoint($total),
                'result_is_passed' => getGradePoint($total) > 0 ? 1 : 0,
                'result_modified_at' => timestamp()
            ];
            if ($value['type'] == 'add') {
                $adds[] = $row;
            } 
            if ($value['type'] == 'edit') {
                $edits[] = $row;
            }
        }


        $examModel = $this->load->model('ExamModel');
        if (count($adds) > 0) 
            $examModel->examSubjectResultInsertMultiple($adds);
        
        if (count($edits) > 0)
            $examModel->examSubjectResultUpdateMultiple($edits);

        return sendJsonSuccess('Marks Updated');
    }

}
