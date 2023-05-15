<?php
declare(strict_types = 1);


use Core\ClassLoader;
use Core\Database;
use Core\Router;

// Configuration file
require_once __DIR__ . '/App/config.php';


// include all core functions
foreach (glob(__DIR__ . '/Core/functions/*.php') as $file) {
    require_once $file;
}

// include all app functions
foreach (glob(__DIR__ . '/App/functions/*.php') as $file) {
    require_once $file;
}

// include Class Auto loader
require_once __DIR__ . '/Core/ClassLoader.php';
ClassLoader::is_strip_namespace(true);
ClassLoader::add_paths([
    __DIR__. '/Core/',
    __DIR__. '/App/Controlers',
    __DIR__. '/App/Controlers/admin'
]);
ClassLoader::init();

// set Database configs
foreach ($dbconf as $key => $val) {
    Database::setConfig($key, $val);
} 



$router = new Router;

$router->get('/', \Controler\HomeControler::class);

$router->get('/home', \Controler\HomeControler::class);

$router->get('/login/{str:type}', \Controler\LoginControler::class);
$router->post('/login/{str:type}', \Controler\LoginControler::class, 'loginUser');

// admission & verification
$router->get('/admission', \Controler\AdmissionControler::class);
$router->post('/admission/get_selectable_subjects', \Controler\AdmissionControler::class, 'getSelectableSubjects');
$router->post('/admission-submit', \Controler\AdmissionControler::class, 'registerStudent');
$router->get('/sms-verification', \Controler\AdmissionControler::class, 'smsVerification');


// student panel
$router->get('/dashboard', \Controler\StudentControler::class, 'dashboardView');
$router->get('/result', \Controler\StudentControler::class, 'resultView');
$router->get('/academic', \Controler\StudentControler::class, 'academicView');
$router->get('/payment', \Controler\StudentControler::class, 'paymentView');
$router->get('/profile', \Controler\StudentControler::class, 'profileView');
$router->get('/logout/{token}', \Controler\LoginControler::class, 'logoutUser');


// admin panel
$router->get('/admin/dashboard', \Controler\AdminControler::class, 'dashboardView');

$router->get('/admin/manage-students', \Controler\AdminControler::class, 'manageStudentsView');
    //student management
    $router->get('/admin/manage-students/approval', \Controler\StudentManagement::class, 'approvalView');
    $router->post('/admin/manage-students/approval/info', \Controler\StudentManagement::class, 'infoView');
    $router->post('/admin/manage-students/approval/action', \Controler\StudentManagement::class, 'approvalAction');

    $router->get('/admin/manage-students/manage', \Controler\StudentManagement::class, 'manageView');
    $router->post('/admin/manage-students/manage/info', \Controler\StudentManagement::class, 'infoView');
    $router->post('/admin/manage-students/manage/edit', \Controler\StudentManagement::class, 'editView');
    $router->post('/admin/manage-students/manage/update', \Controler\StudentManagement::class, 'updateInfo');
    $router->get('/admin/manage-students/register', \Controler\StudentManagement::class, 'registerView');


$router->get('/admin/manage-teachers', \Controler\AdminControler::class, 'manageTeachersView');
    //teacher management
    $router->get('/admin/manage-teachers/manage', \Controler\TeacherManagement::class, 'manageView');
    $router->get('/admin/manage-teachers/register', \Controler\TeacherManagement::class, 'registerView');

$router->get('/admin/profile', \Controler\AdminControler::class, 'profileView');


$router->get('/admin/settings', \Controler\AdminControler::class, 'settingsView');
    $router->get('/admin/settings/institute_basic', \Controler\SettingsControler::class, 'instituteBasicView');
    $router->post('/admin/settings/institute_basic/update', \Controler\SettingsControler::class, 'instituteBasicUpdate');

    $router->get('/admin/settings/institute_head', \Controler\SettingsControler::class, 'instituteHeadView');
    $router->get('/admin/settings/institute_chairman', \Controler\SettingsControler::class, 'instituteChairmanView');

    $router->get('/admin/settings/notices', \Controler\SettingsControler::class, 'noticeView');
    $router->get('/admin/settings/notices/{id}', \Controler\SettingsControler::class, 'noticeDetailsView');
    $router->post('/admin/settings/notices/add', \Controler\NoticeControler::class, 'addNotice');

    $router->get('/admin/settings/gallery', \Controler\SettingsControler::class, 'galleryView');
    $router->post('/admin/settings/gallery/action', \Controler\SettingsControler::class, 'galleryActions');

    $router->get('/admin/settings/classes', \Controler\SettingsControler::class, 'classesView');
    $router->post('/admin/settings/classes/action', \Controler\SettingsControler::class, 'classesActions');

    $router->get('/admin/settings/sections', \Controler\SettingsControler::class, 'sectionsView');
    $router->post('/admin/settings/sections/action', \Controler\SettingsControler::class, 'sectionsActions');

    $router->get('/admin/settings/subjects', \Controler\SettingsControler::class, 'subjectsView');
    $router->post('/admin/settings/subjects/action', \Controler\SettingsControler::class, 'subjectsActions');

    $router->get('/admin/settings/exams', \Controler\SettingsControler::class, 'examsView');
    $router->post('/admin/settings/exams/action', \Controler\SettingsControler::class, 'examsActions');


$router->get('/admin/operations', \Controler\AdminControler::class, 'operationsView');
    $router->get('/admin/operations/exam_mark_distribution', \Controler\OperationsControler::class, 'examMarkView');
    $router->post('/admin/operations/exam_mark_distribution/action', \Controler\OperationsControler::class, 'examMarkEntry');



$router->get('/admin/report', \Controler\AdminControler::class, 'reportView');
    $router->get('/admin/report/id_card', \Controler\ReportControler::class, 'idCardView');

    $router->get('/admin/report/exam_result', \Controler\ReportControler::class, 'examResultView');
    $router->get('/admin/report/exam_result/genarate', \Controler\ReportControler::class, 'examResultGenarate');

    $router->get('/admin/report/get_result_card', \Controler\ReportControler::class, 'resultCardView');


// error handles
$router->get('/error/404', \Controler\ErrorPageControler::class);
$router->get('/error/noscript', \Controler\ErrorPageControler::class, 'noscript');


// default handle
$router->default(\Controler\ErrorPageControler::class, 'main');


// fire it up
$router->run();


