<?php

require_once 'php/config.php';

require_once 'FoodData.php';
require_once 'SessionManager.php';

/**
 * Description of FoodController
 */
class FoodController {

    protected static $instance;
    private static $foodData = null;
    public static $tab = false;

    private function __construct() {
        
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new FoodController();
            if (SessionManager::getInstance()->getFoodData() != null)
                self::$foodData = SessionManager::getInstance()->getFoodData();
        }
        return self::$instance;
    }

    public function list_food() {
        if (!empty($_GET['reset'])) {
            self::resetSession();
        }
        if (self::getFoodData() == null)
            self::populateFoodData();
        if (!empty($_GET['disable'])) {
            self::disableFood($_GET['disable']);
        }
        if (!empty($_POST['addBasic'])) {
            self::addBasic();
        }
        if (!empty($_POST['editBasic'])) {
            self::editBasic();
        }
        if (!empty($_POST['addComposite'])) {
            self::addComposite();
        }
        if (!empty($_POST['editComposite'])) {
            self::editComposite();
        }
        if (!empty($_POST['undo'])) {
            $foodData = &self::getFoodData();
            $foodData->setMemento(FoodCareTaker::getInstance()->undo());
        }
        if (!empty($_POST['redo'])) {
            $foodData = &self::getFoodData();
            $foodData->setMemento(FoodCareTaker::getInstance()->redo());
        }

        $undoEnabled = FoodCareTaker::getInstance()->countUndo() > 0;
        $redoEnabled = FoodCareTaker::getInstance()->countRedo() > 0;
        include ('views/foodEntry.php');
        if (!empty($_GET['save'])) {
            self::getFoodData()->save(self::getFoodDataFilename());
        }
    }

    public static function getFoodDataFilename() {
        return 'data' . DIRECTORY_SEPARATOR . SessionManager::getInstance()->getUser()->getUsername() . DIRECTORY_SEPARATOR . 'food.json';
    }

    public function populateFoodData() {
        self::$foodData = FoodData::getPopulatedFoodData(self::getFoodDataFilename());
        if (empty(self::$foodData))
            self::$foodData = new FoodData();
        SessionManager::getInstance()->setFoodData(self::$foodData);
        FoodCareTaker::getInstance()->record(self::$foodData->createMemento());
    }

    public static function getFoodData() {
        return self::$foodData;
    }

    public function getDisableUri($id) {
        return 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'] . '?food=list_food&disable=' . $id;
    }

    private static function disableFood($id) {
        $foods = &self::getFoodData()->getFoods();
        for ($i = 0; $i < count($foods); $i++) {
            if ($foods[$i]->getId() == $_GET['disable']) {
                $foods[$i]->setEnabled(false);
                self::$tab = $foods[$i]->hasChildren();
            }
        }
        FoodCareTaker::getInstance()->record(self::getFoodData()->createMemento());
    }
  
  private static function resetSession()
  {
    self::$foodData = null;
  	SessionManager::getInstance()->setFoodData(null);
  	self::$tab = false;
  }
  
  private static function addBasic()
  {
  	$foodData = &self::getFoodData();
  	$b = new BasicFood($_POST['foodName']);
  	$b->createUniqueId();
  	$b->setKeywords(explode(', ', $_POST['keywords']));
  	$nutFacts = array(new NutritionFact('calories', $_POST['calories']));
  	$b->setNutritionFacts($nutFacts);
  	$foodData->addFood($b);
  	self::$tab = false;
    FoodCareTaker::getInstance()->record($foodData->createMemento());
  }

    private static function editBasic() {
        $foods = &self::getFoodData()->getFoods();
        for ($i = 0; $i < count($foods); $i++) {
            if ($foods[$i]->getId() == $_POST['foodId']) {
                $foods[$i]->setName($_POST['foodName']);
                $foods[$i]->setKeywords(explode(', ', $_POST['keywords']));
                $foods[$i]->setNutritionFact('calories', $_POST['calories']);
            }
        }
        self::$tab = false;
        FoodCareTaker::getInstance()->record(self::getFoodData()->createMemento());
    }

    private static function editComposite() {
        $foods = &self::getFoodData()->getFoods();
        for ($i = 0; $i < count($foods); $i++) {
            if ($foods[$i]->getId() == $_POST['foodId']) {
                $foods[$i]->setName($_POST['foodName']);
                $foods[$i]->setKeywords(explode(', ', $_POST['keywords']));
            }
        }
        self::$tab = true;
        FoodCareTaker::getInstance()->record(self::getFoodData()->createMemento());
    }

    private static function addComposite() {
        $c = new CompositeFood($_POST['foodName']);
        $c->createUniqueId();
        $c->setKeywords(explode(', ', $_POST['keywords']));
        $childs = array();
        $foodData = &self::getFoodData();
        $maxIndex = (int) $_POST['maxIndex'];
        for ($i = 0; $i < $maxIndex; $i++) {
            if (!empty($_POST['id' . ($i + 1)])) {
                $f = FoodData::findFood($foodData, $_POST['id' . ($i + 1)]);
                if ($f != null) {
                    if (!empty($_POST['servings' . ($i + 1)])) {
                        $servings = $_POST['servings' . ($i + 1)];
                        for ($j = 0; $j < $servings; $j++) {
                            array_push($childs, $f);
                        }
                    }
                }
            }
        }
        $c->setChildren($childs);
        self::getFoodData()->addFood($c);
        self::$tab = true;
        FoodCareTaker::getInstance()->record(self::getFoodData()->createMemento());
    }

}

?>
