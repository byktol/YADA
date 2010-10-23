<?php

$task = $_POST['task'];

switch ($task) {
    case 'register':
        echo "handlign registration";
        break;

    case 'login':

    default:
        echo "No task to handle!";
}
?>
