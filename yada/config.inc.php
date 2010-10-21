<?php

define('DOMAIN', "http://" . $_SERVER['HTTP_HOST']);
define('PATH', 'yada/yada/');
define('PROJECT_CODE', 'YADA');
define('PROJECT_NAME', 'Yet Another Diet Assistant');
define('APPS_SALT', md5('c@$@8lanca'));    // casablanca

/* database constants */
define('DB_HOST', 'localhost');
//define('DB_HOST', '192.168.0.9');

define('HOST', DOMAIN . '/' . PATH);
define('BASE', $_SERVER['DOCUMENT_ROOT'] . '/' . PATH);
define('PHPSELF', $_SERVER['PHP_SELF']);

define('CONFIG', DOMAIN . '/config.php');
define('HEADER', DOMAIN . '/includes/header.php');
define('FOOTER', DOMAIN . '/includes/footer.php');

define('JS', HOST . 'js/');
define('JQUERY', JS . 'jquery-1.4.2.min.js');
define('JQUERY_UI', JS . 'ui/blitzer/jquery-ui-1.7.3.min.js');
define('CSS_PATH', HOST . 'css/');
?>