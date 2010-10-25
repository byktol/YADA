<?php
define('DOMAIN', "http://" . $_SERVER['HTTP_HOST']);
define('PATH', '/YADA/yada/');
define('PROJECT_CODE', 'YADA');
define('PROJECT_NAME', 'Yet Another Diet Assistant');
define('APPS_SALT', md5('c@$@8lanca'));    // casablanca

/* database constants */
define('DB_HOST', 'localhost');
//define('DB_HOST', '192.168.0.9');

define('HOST', DOMAIN . PATH);
define('BASE', $_SERVER['DOCUMENT_ROOT'] . '/' . PATH);
define('PHPSELF', $_SERVER['PHP_SELF']);

define('CONFIG', BASE . '/config.php');
define('HEADER', BASE . 'views/header.php');
define('FOOTER', BASE . 'views/footer.php');

// classes
define('CLASSES', HOST . '/php/');
define('USER', CLASSES . 'User.php');
define('CAL_METRICS', CLASSES . 'Calmetrics.php');

define('JS', HOST . 'js/');
define('JQUERY', JS . 'jquery-1.4.2.min.js');
define('JQUERY_UI', JS . 'ui/redmond/jquery-ui-1.8.5.min.js');
define('TBL_SORTER', JS . 'tablesorter/jquery.tablesorter.min.js');
define('CSS_PATH', HOST . 'css/');
define('JQUERY_CSS', JS . 'ui/redmond/jquery-ui-1.8.5.css');
define('TBL_SORTER_BLUE', JS . 'tablesorter/blue/style.css');

// database files
define('DATA', BASE . 'data/');
define('DATA_USERS', DATA . 'users.json');

function __autoload($classname) {
    //$file = str_replace('_', '/', $classname);
    $file = './' . $classname . '.php';
    if (file_exists($file)) {
        require_once($file);
    } else {
        $file = './php/' . $classname . '.php';
        if (file_exists($file)) {
            require_once($file);
        } else {
            $file = './views/' . $classname . '.php';
            if (file_exists($file)) {
                require_once($file);
            }
        }
    }
}

?>
