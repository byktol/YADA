<?php
require_once 'boot.php';
session_start();
$userController = UserController::getInstance();
$foodController = FoodController::getInstance();

if (isset($_GET['user'])) {
    $userController->$_GET['user']();
} else if (isset($_GET['food'])) {
    $foodController->$_GET['food']();
} else {
    $userController->login();
}
?>
