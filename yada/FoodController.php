<?php
require_once 'php/config.php';

require_once 'FoodData.php';

/**
 * Description of FoodController
 */
class FoodController {
  protected static $instance;
  
  private static $foodData = null;

  private function __construct() { }

  public static function getInstance() {
    if ( !isset(self::$instance) ) {
      self::$instance = new FoodController();
      if(!empty($_SESSION['FOOD_DATA']))
        self::$foodData = $_SESSION['FOOD_DATA'];
    }
    return self::$instance;
  }

  public function list_food() {
    if(!empty($_GET['reset']))
  	{
  	  self::resetSession();
  	}
    if(self::getFoodData() == null)
      self::populateFoodData();
  	if(!empty($_GET['disable']))
  	{
  	  self::disableFood($_GET['disable']);
  	}
  	if(!empty($_POST['addBasic']))
  	{
  	  self::addBasic();
  	}
  	if(!empty($_POST['editBasic']))
  	{
  	  self::editBasic();
  	}
  	if(!empty($_POST['addComposite']))
  	{
  	  self::addComposite();
  	}
    if(!empty($_POST['editComposite']))
  	{
  	  self::editComposite();
  	}
    include ('views/foodEntry.php');
    self::getFoodData()->save('php/test_json.json');
  }
  
  public function populateFoodData()
  {
    self::$foodData = FoodData::getPopulatedFoodData('test_json.json');
    $_SESSION['FOOD_DATA'] = self::$foodData;
  }
  
  public static function getFoodData()
  {
  	return self::$foodData;
  }
  
  public function getDisableUri($id)
  {
  	return 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'].'?food=list_food&disable='.$id;
  }
  
  private static function disableFood($id)
  {
    $foods = &self::getFoodData()->getFoods();
    for($i=0;$i<count($foods);$i++)
    {
      if($foods[$i]->getId() == $_GET['disable'])
      {
        $foods[$i]->setEnabled(false);
      }
    }
  }
  
  private static function resetSession()
  {
    self::$foodData = null;
  	$_SESSION['FOOD_DATA'] = null;
  }
  
  private static function addBasic()
  {
  	$foodData = &self::getFoodData();
  	$b = new BasicFood($_POST['foodName']);
  	$b->createUniqueId();
  	$nutFacts = array(new NutritionFact('calories', $_POST['calories']));
  	$b->setNutritionFacts($nutFacts);
  	$foodData->addFood($b);
  }
  
  private static function editBasic()
  {
    $foods = &self::getFoodData()->getFoods();
    for($i=0;$i<count($foods);$i++)
    {
      if($foods[$i]->getId() == $_POST['foodId'])
      {
        $foods[$i]->setName($_POST['foodName']);
        $foods[$i]->setKeywords(explode(', ', $_POST['keywords']));
        $foods[$i]->setNutritionFact('calories', $_POST['calories']);
      }
    }
  }
  
  private static function editComposite()
  {
    $foods = &self::getFoodData()->getFoods();
    for($i=0;$i<count($foods);$i++)
    {
      if($foods[$i]->getId() == $_POST['foodId'])
      {
        $foods[$i]->setName($_POST['foodName']);
        $foods[$i]->setKeywords(explode(', ', $_POST['keywords']));
      }
    }
  }
  
  private static function addComposite()
  {
    $c = new CompositeFood($_POST['foodName']);
    $c->createUniqueId();
    $c->setKeywords(explode(', ', $_POST['keywords']));
    $childs = array();
    $foodData = &self::getFoodData();
    $maxIndex = (int)$_POST['maxIndex'];
    for($i=0;$i<$maxIndex;$i++)
    {
      if(!empty($_POST['id'.($i+1)]))
      {
        $f = FoodData::findFood($foodData, $_POST['id'.($i+1)]);
        if($f != null)
        {
          if(!empty($_POST['servings'.($i+1)]))
          {
            $servings = $_POST['servings'.($i+1)];
            for($j=0;$j<$servings;$j++)
            {
              array_push($childs, $f);
            }
          }
        }
      }
    }
    $c->setChildren($childs);
    self::getFoodData()->addFood($c);
  }
}
?>
