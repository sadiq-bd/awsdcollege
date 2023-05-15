<?php

namespace Controler;

use \Core\Controler;
use Core\Session;
use \Controler\AdminControler;


class SettingsControler extends AdminControler {

    private $siteOptions = array();
    
    public function __construct() {
        parent::__construct();

        $optionModel = $this->load->model('OptionModel');
        $this->siteOptions = $optionModel->getAllOptions();

    }


    public function instituteBasicView() {

        $this->load->view('inc/basic-header');
        $this->load->view('admin/inc/admin-nav');
        $this->load->view('admin/settings/basic_info', array(
            'siteOptions' => $this->siteOptions
        ));
        $this->load->view('inc/basic-footer');
    
    }


    public function instituteBasicUpdate() {
        $postData = postDataRetrieve();
        $optionModel = $this->load->model('OptionModel');
        foreach ($postData as $key => $value) {
            $optionModel->update('option_name = :optName', array(
                'optName' => $key
            ), array(
                'option_value' => $value
            ));
        }

        return sendJsonSuccess('Updated Successfully');
    }


    public function instituteHeadView() {

        $this->load->view('inc/basic-header');
        $this->load->view('admin/inc/admin-nav');
        $this->load->view('admin/settings/head', array(
            'siteOptions' => $this->siteOptions
        ));
        $this->load->view('inc/basic-footer');
    }

    public function instituteChairmanView() {

        $this->load->view('inc/basic-header');
        $this->load->view('admin/inc/admin-nav');
        $this->load->view('admin/settings/chairman', array(
            'siteOptions' => $this->siteOptions
        ));
        $this->load->view('inc/basic-footer');
    }

    public function noticeView() {

        
        $cond = null;
        $data = [];
        $sort = 1;
        $limit = 10;
        $offset = 0;
        $page = 1;

        if (!empty($_GET['page'])) {
            if (filter_var($_GET['page'], FILTER_VALIDATE_INT)) {
                $page = $_GET['page'];
                $offset = $limit * ($page - 1);
            }
        }

        if (!empty($_GET['search'])) {
            $q = $_GET['search'];

            $cond = <<<QUERY
                notice_title LIKE :title OR 
                notice_body LIKE :body OR
                notice_date LIKE :date 
            QUERY;
            $data = [
                'title' => '%'.$q.'%','body' => '%'.$q.'%','date' => '%'.$q.'%'
            ];
            
        }

        
        $noticeModel = $this->load->model('NoticeModel');
        $totalRow = $noticeModel->totalRowCount($cond, $data);
        $notices = $noticeModel->getList($cond, $data, 'ID', $sort, $limit, $offset);
        $totalPageCount = ceil($totalRow / $limit);

        $this->load->view('inc/basic-header');
        $this->load->view('admin/inc/admin-nav');
        $this->load->view('admin/settings/notices', array(
            'siteOptions' => $this->siteOptions,
            'notices' => $notices,
            'totalPageCount' => $totalPageCount
        ));
        $this->load->view('inc/basic-footer');
    }

    public function noticeDetailsView($param) {

        $noticeModel = $this->load->model('NoticeModel');
        $noticeData = @$noticeModel->getBy('notice_unique_id', $param['id'])[0];

        if (!empty($noticeData)) {

            $this->load->view('inc/basic-header');
            $this->load->view('admin/inc/admin-nav');
            $this->load->view('admin/settings/noticeDetails', array(
                'noticeData' => $noticeData
            ));
            $this->load->view('inc/basic-footer');

        } else {
            sendJsonError('Notice Not Found', 404);
        }
    }


    public function galleryView() {

        $sliderModel = $this->load->model('SliderModel');
        $galleryModel = $this->load->model('GalleryModel');

        $sliders = $sliderModel->getList(null, [], 'ID', 0);
        $gallery = $galleryModel->getList(null, [], 'ID', 0);

        $this->load->view('inc/basic-header');
        $this->load->view('admin/inc/admin-nav');
        $this->load->view('admin/settings/gallery', array(
            'siteOptions' => $this->siteOptions,
            'sliders' => $sliders,
            'gallery' => $gallery
        ));
        $this->load->view('inc/basic-footer');
    }


    public function classesView() {

        $classModel = $this->load->model('ClassModel');
        $classes = $classModel->getList(null, [], 'ID', 1);

        $this->load->view('inc/basic-header');
        $this->load->view('admin/inc/admin-nav');
        $this->load->view('admin/settings/classes', array(
            'siteOptions' => $this->siteOptions,
            'classes' => $classes
        ));
        $this->load->view('inc/basic-footer');
    }

    public function classesActions () {
        $postData = postDataRetrieve();

        $classModel = $this->load->model('ClassModel');
        switch ($postData['action']) {
            case 'add':
                if ($classModel->insert([
                    'class_name' => @$postData['className'],
                    'class_admission_status' => (@$postData['classAdmissionStatus'] == 'true') ? 1 : 0,
                    'class_has_group' => (@$postData['classHasGroup'] == 'true') ? 1 : 0,
                    'class_meta' => @$postData['classMeta']
                ])) return sendJsonSuccess('Class Added');
                else return sendJsonError('Error');

                break;
            case 'edit':
                if ($classModel->update('ID = :id', ['id' => @$postData['actionValue']], [
                    'class_name' => @$postData['className'],
                    'class_admission_status' => (@$postData['classAdmissionStatus'] == 'true') ? 1 : 0,
                    'class_has_group' => (@$postData['classHasGroup'] == 'true') ? 1 : 0,
                    'class_meta' => @$postData['classMeta']
                ])) return sendJsonSuccess('Class Updated');
                else return sendJsonError('Error');

                break;
            case 'delete':
                if ($classModel->delete('ID = :id', ['id' => @$postData['actionValue']]))
                return sendJsonSuccess('Class Deleted');
                else return sendJsonError('Error');
                break;
        }
    }

    public function sectionsView() {

        $sectionModel = $this->load->model('SectionModel');
        $cond = null;
        $condData = [];
        if (!empty($_GET['filter'])) {
            $cond = 'section_class_id = :cid';
            $condData = ['cid' => $_GET['filter']];
        }
        $sections = $sectionModel->getList($cond, $condData, 'ID', 1);
        $classModel = $this->load->model('ClassModel');
        $classes = $classModel->getList(null, [], 'ID', 1);
        $classIdIndexed = array();
        map($classes, function($value, $key) use (&$classIdIndexed) {
            $classIdIndexed[$value['ID']] = $value;
        });
        

        $this->load->view('inc/basic-header');
        $this->load->view('admin/inc/admin-nav');
        $this->load->view('admin/settings/sections', array(
            'sections' => $sections,
            'classes' => $classIdIndexed,
            'siteOptions' => $this->siteOptions
        ));
        $this->load->view('inc/basic-footer');
    }

    public function sectionsActions() {
        $postData = postDataRetrieve();

        $sectionModel = $this->load->model('SectionModel');
        switch ($postData['action']) {
            case 'add':
                if ($sectionModel->insert([
                    'section_class_id' => @$postData['sectionClassId'],
                    'section_title' => @$postData['sectionTitle'],
                    'section_meta' => @$postData['sectionMeta']
                ])) return sendJsonSuccess('Section Added');
                else return sendJsonError('Error');

                break;
            case 'edit':
                if ($sectionModel->update('ID = :id', ['id' => @$postData['actionValue']], [
                    'section_class_id' => @$postData['sectionClassId'],
                    'section_title' => @$postData['sectionTitle'],
                    'section_meta' => @$postData['sectionMeta']
                ])) return sendJsonSuccess('Section Updated');
                else return sendJsonError('Error');

                break;
            case 'delete':
                if ($sectionModel->delete('ID = :id', ['id' => @$postData['actionValue']]))
                return sendJsonSuccess('Section Deleted');
                else return sendJsonError('Error');
                break;
        }
    }



    public function subjectsView() {

        
        $subjectModel = $this->load->model('SubjectModel');
        $cond = null;
        $condData = [];
        if (!empty($_GET['filter'])) {
            $filter = @explode(',', $_GET['filter']);

            if (!empty($filter[0])) {
                $cond = '';
                $cond .= 'subject_class_id = :cid';
                $condData = array_merge($condData, ['cid' => $filter[0]]);
            }
            if (!empty($filter[1])) {
                if ($cond === null) $cond = '';
                $cond .= strlen($cond) < 1 ? 'subject_group_id = :gid' : ' AND subject_group_id = :gid';
                $condData = array_merge($condData, ['gid' => $filter[1]]);
            }
            
        }
        $subjects = $subjectModel->getList($cond, $condData, 'ID', 1);

        $classModel = $this->load->model('ClassModel');
        $classes = $classModel->getList(null, [], 'ID', 1);
        $classIdIndexed = array();
        map($classes, function($value, $key) use (&$classIdIndexed) {
            $classIdIndexed[$value['ID']] = $value;
        });
        
        $groupModel = $this->load->model('GroupModel');
        $groups = $groupModel->getList(null, [], 'ID', 1);
        $groupIdIndexed = array();
        map($groups, function($value, $key) use (&$groupIdIndexed) {
            $groupIdIndexed[$value['ID']] = $value;
        });
        



        $this->load->view('inc/basic-header');
        $this->load->view('admin/inc/admin-nav');
        $this->load->view('admin/settings/subjects', array(
            'subjects' => $subjects,
            'classes' => $classIdIndexed,
            'groups' => $groupIdIndexed,
            'siteOptions' => $this->siteOptions
        ));
        $this->load->view('inc/basic-footer');
    }


    
    public function subjectsActions() {
        $postData = postDataRetrieve();

        $subjectModel = $this->load->model('SubjectModel');
        switch ($postData['action']) {
            case 'add':

                if ($subjectModel->insert([
                    'subject_code' => @$postData['subjectCode'],
                    'subject_title' => @$postData['subjectTitle'],
                    'subject_class_id' => @$postData['subjectClassId'],
                    'subject_group_id' => @$postData['subjectGroupId'],
                    'subject_cq_mark' => @$postData['subjectCqMark'],
                    'subject_mcq_mark' => @$postData['subjectMcqMark'],
                    'subject_practical_mark' => @$postData['subjectPracticalMark'],
                    'subject_is_optionalable' => @$postData['subjectIsOptionalable'] == 'true' ? 1 : 0,
                    'subject_is_4th_subjectable' => @$postData['subjectIs4thSubjectable'] == 'true' ? 1 : 0
                ])) return sendJsonSuccess('Subject Added');
                else return sendJsonError('Error');

                break;
            case 'edit':

                if ($subjectModel->update('ID = :id', ['id' => @$postData['actionValue']], [
                    'subject_code' => @$postData['subjectCode'],
                    'subject_title' => @$postData['subjectTitle'],
                    'subject_class_id' => @$postData['subjectClassId'],
                    'subject_group_id' => @$postData['subjectGroupId'],
                    'subject_cq_mark' => @$postData['subjectCqMark'],
                    'subject_mcq_mark' => @$postData['subjectMcqMark'],
                    'subject_practical_mark' => @$postData['subjectPracticalMark'],
                    'subject_is_optionalable' => @$postData['subjectIsOptionalable'] == 'true' ? 1 : 0,
                    'subject_is_4th_subjectable' => @$postData['subjectIs4thSubjectable'] == 'true' ? 1 : 0
                ])) return sendJsonSuccess('Subject Updated');
                else return sendJsonError('Error');

                break;
            case 'delete':
                if ($subjectModel->delete('ID = :id', ['id' => @$postData['actionValue']]))
                return sendJsonSuccess('Subject Deleted');
                else return sendJsonError('Error');
                break;
        }
    }



    public function examsView() {

        $examModel = $this->load->model('ExamModel');
        $cond = null;
        $condData = [];
        if (!empty($_GET['filter'])) {
            $filter = @explode(',', $_GET['filter']);

            if (!empty($filter[0])) {
                $cond = '';
                $cond .= 'exam_class_id = :cid';
                $condData = array_merge($condData, ['cid' => $filter[0]]);
            }
            if (!empty($filter[1])) {
                if ($cond === null) $cond = '';
                $cond .= strlen($cond) < 1 ? 'exam_group_id = :gid' : ' AND exam_group_id = :gid';
                $condData = array_merge($condData, ['gid' => $filter[1]]);
            }
            
        }
        $exams = $examModel->getList($cond, $condData, 'ID', 1);

        $classModel = $this->load->model('ClassModel');
        $classes = $classModel->getList(null, [], 'ID', 1);
        $classIdIndexed = array();
        map($classes, function($value, $key) use (&$classIdIndexed) {
            $classIdIndexed[$value['ID']] = $value;
        });
        
        $groupModel = $this->load->model('GroupModel');
        $groups = $groupModel->getList(null, [], 'ID', 1);
        $groupIdIndexed = array();
        map($groups, function($value, $key) use (&$groupIdIndexed) {
            $groupIdIndexed[$value['ID']] = $value;
        });
        

        $this->load->view('inc/basic-header');
        $this->load->view('admin/inc/admin-nav');
        $this->load->view('admin/settings/exams', array(
            'exams' => $exams,
            'classes' => $classIdIndexed,
            'groups' => $groupIdIndexed,
            'siteOptions' => $this->siteOptions
        ));
        $this->load->view('inc/basic-footer');
    }

    
    public function examsActions() {
        $postData = postDataRetrieve();

        $examModel = $this->load->model('ExamModel');
        switch ($postData['action']) {
            case 'add':
                if ($examModel->insert([
                    'exam_title' => @$postData['examTitle'],
                    'exam_class_id' => @$postData['examClassId'],
                    'exam_group_id' => @$postData['examGroupId'],
                    'exam_year' => @$postData['examYear'],
                    'exam_start_date' => @date('Y-m-d', @strtotime(@$postData['examStartDate'])),
                    'exam_end_date' => @date('Y-m-d', @strtotime(@$postData['examEndDate'])),
                    'exam_grade_point_out_of' => @$postData['examGradePoint'],
                    'exam_is_result_published' => @$postData['examIsResultPublished'] == 'true' ? 1 : 0
                ])) return sendJsonSuccess('Exam Added');
                else return sendJsonError('Error');

                break;
            case 'edit':
                if ($examModel->update('ID = :id', ['id' => @$postData['actionValue']], [
                    'exam_title' => @$postData['examTitle'],
                    'exam_class_id' => @$postData['examClassId'],
                    'exam_group_id' => @$postData['examGroupId'],
                    'exam_year' => @$postData['examYear'],
                    'exam_start_date' => @date('Y-m-d', @strtotime(@$postData['examStartDate'])),
                    'exam_end_date' => @date('Y-m-d', @strtotime(@$postData['examEndDate'])),
                    'exam_grade_point_out_of' => @$postData['examGradePoint'],
                    'exam_is_result_published' => @$postData['examIsResultPublished'] == 'true' ? 1 : 0
                ])) return sendJsonSuccess('Exam Updated');
                else return sendJsonError('Error');

                break;
            case 'delete':
                if ($examModel->delete('ID = :id', ['id' => @$postData['actionValue']]))
                return sendJsonSuccess('Exam Deleted');
                else return sendJsonError('Error');
                break;
        }
    }


}



