<?php

/**
 * Configuration file
 */
// APP Root
define('APP_ROOT', $_SERVER['DOCUMENT_ROOT']);

//init config
$config = array();

if (preg_match('/(127\.0\.0\.1|localhost)(\:\d+)?/i', $_SERVER['HTTP_HOST'])) {
    $config['base_url'] = 'http://' . $_SERVER['HTTP_HOST'];
} else {
    $config['base_url'] = 'https://' . $_SERVER['HTTP_HOST'];
}

$config['page'] = array(
    'title'         => 'আব্দুল ওদুদ শাহ ডিগ্রী কলেজ, দামুড়হুদা, চুয়াডাঙ্গা ।',
    'description'   => 'আব্দুল ওদুদ শাহ ডিগ্রী কলেজ, দামুড়হুদা, চুয়াডাঙ্গা ।',
    'keywords'      => '',
    'favicon'       => $config['base_url'] . '/resources/favicon.png'
);

/**
 * Mail Configuration
 */
// init mail
$config['mail'] = array();

/**
 * Mail SMTP Host
 */
$config['mail']['smtp']['host'] = 'smtp.gmail.com';

/**
 * Mail SMTP User
 */
$config['mail']['smtp']['user'] = 'user@gmail.com';

/**
 * Mail SMTP Password
 */
$config['mail']['smtp']['password'] = 'bjoohfruckiowvht';

/**
 * Mail SMTP Encryption
 */
$config['mail']['smtp']['encryption'] = 'tls';

/**
 * Mail SMTP Port
 */
$config['mail']['smtp']['port'] = 587;

/**
 * Mail SMTP From
 */
$config['mail']['smtp']['from'] = 'user@gmail.com';



// DIRs listing
$config['dirs'] = [
    'images' => [
        'students' => '/resources/images/student',
        'teachers' => '/resources/images/teacher'
    ]
];


/**
 * Database configurations
 */

// Init Database Config
$dbconf = array();


/**
 * Database type (Optional; Default mysql)
 */
# $dbconf['type'] = 'mysql';


/**
 * Database Hostname
 */
$dbconf['host'] = '127.0.0.1';

/**
 * Database Username
 */
$dbconf['user'] = 'root';

/**
 * Database password
 */
$dbconf['password'] = '4616';

/**
 * Database port (Optional; Default 3306)
 */
# $dbconf['port'] = 3306;

/**
 * Database name
 */
$dbconf['dbname'] = 'awsdcollege';

/**
 * Database Character set
 */
$dbconf['charset'] = 'utf8mb4';

/**
 * Database data fetch mode (Default: obj)
 *      'assoc' |  'obj'  |  'num'
 */
$dbconf['fetch_mode'] = 'assoc';

/**
 * Database Error Mode (Default: exception)
 */
$dbconf['errmode'] = 'exception';

/**
 * Database Emulate Prepares (Default: false)
 */
$dbconf['emulate_prepares'] = false;



define('CONFIG', $config);
define('DB_CONFIG', $dbconf);


/**
* defaut timezone
*/
date_default_timezone_set('Asia/Dhaka');



  
