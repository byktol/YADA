<?php
define('$DEBUG', true);
$INCLUDE_PATH = dirname(dirname(__FILE__));
$INCLUDE_PATH_2 = dirname(__FILE__);

set_include_path(get_include_path() . PATH_SEPARATOR . $INCLUDE_PATH . PATH_SEPARATOR . $INCLUDE_PATH_2);

if($DEBUG)
{
	error_reporting(E_ALL);
	ini_set('display_errors', true);
}
?>