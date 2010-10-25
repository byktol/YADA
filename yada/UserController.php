<?php

require_once('php/Builder.php');

/**
 * Provides the methods for user interface handling of the users and the logs.
 */
class UserController {

    protected static $instance;

    private function __construct() {

    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new UserController();
        }
        return self::$instance;
    }

    public function login() {
        $username = '';
        if ($_POST) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if ($username != '' && $this->userExists($username)) {

                $udao = new UserDAO();
                $user = $udao->getUser($username);
                if ($password != $user->getPassword()) {
                    SessionManager::getInstance()->error('Password invalid!');
                } else {
                    SessionManager::getInstance()->setUser($user);
                    Utils::getInstance()->redirect('index.php?user=profile');
                    return;
                }
            } else {

                SessionManager::getInstance()->error("Dude, you're doing it wrong!");
            }
        }

        //also load the food data
        $foodCtrl = FoodController::getInstance();
       
        include 'views/login.php';
        $foodCtrl->populateFoodData($username);
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
                $success = mkdir($userDir, 0777);
                if (true || $success) {
                    $user = new User();
                    $user->setUsername($username);
                    $user->setPassword($password);

                    $udao = new UserDAO();
                    $udao->save($user);

                    SessionManager::getInstance()->setUser($user);
                    SessionManager::getInstance()->info('Welcome to YADA, ' . $user->getUsername());

                    Utils::getInstance()->redirect('index.php?user=profile');
                    return;
                } else {
                    SessionManager::getInstance()->error('An error ocurred. Please contact support.');
                }
            }
        }
        include 'views/register.php';
    }

    public function profile() {
        $user = SessionManager::getInstance()->getUser();
        if ($_POST) {
            $udao = new UserDAO();
            $user->setFirstname($_POST['firstname']);
            $user->setLastname($_POST['lastname']);
            $user->setAge($_POST['age']);
            $user->setWeight($_POST['weight']);
            $user->setHeight($_POST['height']);
            $user->setActivityLevel($_POST['activity_level']);
            $user->setGender($_POST['gender']);
            $user->setCalculatorId($_POST['calculator_id']);
            $udao->save($user);

            SessionManager::getInstance()->info('Your profile has been updated.');
        }
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
        $date = '';
        $log = NULL;
        if (isset($_GET['for']) && $_GET['for'] != '') {
            $date = $_GET['for'];

            $sessMgr = SessionManager::getInstance();
            $user = $sessMgr->getUser();
            $foodData = $sessMgr->getFoodData();

            $userDao = new UserDAO();
            $log = $userDao->getLogByDate($user->getUsername(), $date, $foodData);

            include 'views/logEntry.php';
        } else {
            include 'views/dailyLog.php';
        }
    }

    public function log() {
        include 'views/logEntry.php';
    }

    public function saveLog() {
        // TODO: save

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
