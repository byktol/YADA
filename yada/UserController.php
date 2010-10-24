<?php

require_once('php/Builder.php');

/**
 * Provides the methods for user interface handling of the users and the logs.
 */
class UserController {
  protected static $instance;

  private function __construct() { }

  public static function getInstance() {
    if ( !isset(UserController::$instance) ) {
      UserController::$instance = new UserController();
    }
    return UserController::$instance;
  }

  public function login() {
    if ($_POST) {
      $username = $_POST['username'];

      if ($username != '' && realpath('./data/' . $username)) {

        header( 'Location: /YADA/yada/index.php?user=welcome' );
      }
      include 'views/login.php';

    } else {
      include 'views/login.php';
    }
  }

  public function register() {
    if ($_POST) {
      header( 'Location: /YADA/yada/index.php?user=welcome' );


    } else {
      include 'views/register.php';
    }
  }

  public function profile() {
    include 'views/profile.php';
  }

  public function changeCalculator() {

  }

  public function calendar() {
    include 'views/foodLog.php';
  }

  public function welcome() {
    include 'views/welcome.php';
  }

  public function today() {
    include 'views/dailyLog.php';
  }

  public function log() {
    include 'views/logEntry.php';
  }
}
?>
