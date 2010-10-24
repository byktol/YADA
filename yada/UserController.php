<?php

require_once('php/Builder.php');

/**
 * Provides the methods for user interface handling of the users and the logs.
 */
class UserController {
  protected static $instance;

  private function __construct() { }

  public static function getInstance() {
    if ( !isset(self::$instance) ) {
      self::$instance = new UserController();
    }
    return self::$instance;
  }

  public function login() {
    if ($_POST) {
      $username = $_POST['username'];

      if ($username != '' && $this->userExists($username)) {

        header( 'Location: /YADA/yada/index.php?user=welcome' );
      }
      include 'views/login.php';

    } else {
      include 'views/login.php';
    }
  }

  public function register() {
    $username = '';

    if ($_POST) {

      $username = $_POST['username'];
      $password = $_POST['password'];

      $userExists = $this->userExists($username);

      if ($userExists) {
        SessionManager::getInstance()->error('The username you chose <b>'
                . $username . '</b> already exists! Please type another one.');

      } else {

        // Registers a new user.
        $userDir = DATA . $username . '/';
//        $success = mkdir($userDir, 0777);
        if (true || $success) {
//          $f = fopen($userDir . 'profile.json', 'w');
//          fclose($f);
//          $f = fopen($userDir . 'foods.json', 'w');
//          fclose($f);
//          $f = fopen($userDir . 'log.json', 'w');
//          fclose($f);

          $user = new User();
          $user->setName($username);

          SessionManager::getInstance()->setUser($user);
          SessionManager::getInstance()->info('Yay');

          echo (int) SessionManager::getInstance()->isLoggedIn();
//          Utils::getInstance()->redirect('index.php?user=profile');
          return;

        } else {
          SessionManager::getInstance()->error('An error ocurred. Please contact support.');
        }
      }

    }
    include 'views/register.php';
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

  public function logout() {
    session_destroy();

    Utils::getInstance()->redirect('index.php?user=login');
  }

  /**
   * checks if the user already exists
   * @param <type> $username
   * @return boolean
   */
  protected function userExists($username) {
      return (bool) realpath('./data/' . $username);
  }
}
?>
