<?php

//error_reporting(0); 
//error_reporting(ERROR); /* deployment version */

error_reporting(E_ALL & ~E_NOTICE); /* development version */

function __autoload($classname) {
    //$file = str_replace('_', '/', $classname);
    $file = $classname;
    require_once('php/' . $file . '.php');
}

require_once $path . 'config.inc.php';
?>