<?php
$DEBUG = true;
$INCLUDE_PATH = getcwd();

set_include_path(get_include_path() . PATH_SEPARATOR . $INCLUDE_PATH);

if($DEBUG)
{
	error_reporting(E_ALL);
	ini_set('display_errors', true);
}
?>