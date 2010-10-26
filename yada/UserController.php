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
        if (SessionManager::getInstance()->isLoggedIn()) {
            Utils::getInstance()->redirect('index.php?user=profile');
            return;
        }

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
    }

    public function register() {
        if (SessionManager::getInstance()->isLoggedIn()) {
            Utils::getInstance()->redirect('index.php?user=profile');
            return;
        }
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
        $userDao = new UserDAO();

        $sessMgr = SessionManager::getInstance();
        $user = $sessMgr->getUser();
        $foodData = $sessMgr->getFoodData();

        if (isset($_GET['for']) && $_GET['for'] != '') {
            $date = $_GET['for'];
            $log = $userDao->getLogByDate($user->getUsername(), $date, $foodData);

            include 'views/editLog.php';
        } else {
            $arrLogs = $userDao->getAllLog($user->getUsername(), $foodData);

            include 'views/dailyLog.php';
        }
    }

    public function updatelog() {
        $sessMgr = SessionManager::getInstance();
        $user = $sessMgr->getUser();
        $foodData = $sessMgr->getFoodData();

        if (isset($_POST['task']) == 'updateLog') {
            $date = $_POST['log_date'];
            $cnt = count($_POST['foods']);

            $arrNewCnsmp = array();
            for ($i = 0; $i < $cnt; $i++) {
                $arrNewCnsmp[] = array('food_id' => $_POST['foods'][$i], 'qty' => $_POST['qty'][$i]);
            }

            $userDao = new UserDAO();
            $userDao->updateLogByDate($user->getUsername(), $foodData, $date, $arrNewCnsmp);
        }
        $utils = Utils::getInstance();
        $utils->redirect(HOST . 'index.php?user=today&for=' . $date);
    }

    public function deletelog() {
        $sessMgr = SessionManager::getInstance();
        $user = $sessMgr->getUser();
        $foodData = $sessMgr->getFoodData();

        if (isset($_GET['for']) && $_GET['for'] != '') {
            $date = $_GET['for'];
        }

        if (isset($_GET['del']) && $_GET['del'] != '') {
            $consumpFoodId = $_GET['del'];
        }
        if (isset($date) && isset($consumpFoodId)) {
            $userDao = new UserDAO();
            $userDao->delConsumption($date, $consumpFoodId, $user->getUsername(), $foodData);
        }
    }

    public function log() {
        if (SessionManager::getInstance()->getFoodData() == null)
            FoodController::populateFoodData();
        if (!empty($_POST['addLogEntry'])) {
            self::addLogEntry();
        }
        include 'views/logEntry.php';
    }

    public static function addLogEntry() {
        $l = new Log();

        if (!empty($_POST['logDate'])) {
            $l->setDate($_POST['logDate']);
        } else {
            $l->setDate(date('Y-m-d'));
        }

        $arrConsumptions = array();
        $maxIndex = (int) $_POST['maxIndex'];
        $foodData = SessionManager::getInstance()->getFoodData();

        for ($i = 0; $i < $maxIndex; $i++) {
            if (!empty($_POST['id' . ($i + 1)])) {
                $f = FoodData::findFood($foodData, $_POST['id' . ($i + 1)]);
                if ($f != null) {
                    if (!empty($_POST['servings' . ($i + 1)])) {
                        $consum = new Consumption();
                        $consum->setFood($f);
                        $consum->setQuantity($_POST['servings' . ($i + 1)]);

                        array_push($arrConsumptions, $consum);
                    }
                }
            }
        }
        $l->setConsumption($arrConsumptions);
        //print_r($l);
        $dao = new UserDAO();
        $dao->saveLog(SessionManager::getInstance()->getUser()->getUsername(), $l);
    }

    public function memento() {
        $arrayOfood = array(new BasicFood('pickle'));

        $data = new FoodData();
        $data->setFoods($arrayOfood);

        $data->addFood(new BasicFood('tomato'));
        $composite = new CompositeFood('picklemato');
        $composite->setChildren(array(new BasicFood('tomato'), new BasicFood('pickle')));
        FoodCareTaker::getInstance()->record($data->createMemento());
        $data->addFood($composite);
        FoodCareTaker::getInstance()->record($data->createMemento());

        echo '<pre>FIRST';
        print_r($data);
        echo '<br />Undo 1: ';
        echo FoodCareTaker::getInstance()->countUndo();
        echo '<br />';
        print_r(FoodCareTaker::getInstance()->undo());
        echo '<br />Undo 2: ';
        echo FoodCareTaker::getInstance()->countUndo();
        echo '<br />';
        print_r(FoodCareTaker::getInstance()->undo());
        echo '<br />Redo<br />';
        echo 'Count: ' . FoodCareTaker::getInstance()->countRedo();
        print_r(FoodCareTaker::getInstance()->redo());
        echo 'Count: ' . FoodCareTaker::getInstance()->countRedo();
        print_r(FoodCareTaker::getInstance()->redo());
        echo '<br />Forward<br />';
        FoodCareTaker::getInstance()->record($data->createMemento());
        FoodCareTaker::getInstance()->countRedo();
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

    public function getDelURI($id, $date) {
        return '?user=deletelog&for=' . $date . '&del=' . $id;
    }

}

?>
