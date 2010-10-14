<?php
require_once('Builder.php');
require_once('BasicFood.php');
require_once('CompositeFood.php');
require_once('NutritionFact.php');
require_once('Calorie.php');

class JsonBuilder implements Builder {

  private $text = '';
  private $arrayOfFood;

  public function construct($arrayOfFood) {
    $this->arrayOfFood = $arrayOfFood;
  }

  public function buildBasicFood($food = null) {
    if ($food == null) {

      foreach ($this->arrayOfFood as $food) {

        if ($food instanceof BasicFood) {
          $this->text .= $this->buildBasicFood($food);

        }//endif

      }// endforeach
      return;
    }//endif

    $text  = "{\r\n";
    $text .= "  'Name': '". $food->name . "',\r\n";
    $text .= "  'NutritionFacts':\r\n";
    $text .= "  [\r\n";
    $text .= $this->buildNutritionFactsFor($food);
    $text .= "  ]\r\n";
    $text .= "}\r\n";
    return $text;
  }

  public function buildNutritionFactsFor($food) {
    $text = '';
    foreach ($food->nutritionFacts as $fact) {
      $text .= $this->buildNutritionFact($fact);
    }

    return $text;
  }

  public function buildNutritionFact($fact) {
    $text  = "  {\r\n";
    $text .= "    'Name': '". $fact->getName() . "',\r\n";
    $text .= "    'Quantity': " . $fact->getQuantity() . "\r\n";
    $text .= "  }\r\n";
    return $text;
  }

  public function buildCompositeFood($food = null) {
    //This is what happens when this method is invoked with no parameters
    if ($food == null) {

      foreach ($this->arrayOfFood as $food) {
        if ($food instanceof CompositeFood) {
          $this->text .= $this->buildCompositeFood($food);
        }
      }

      return;
    }//endif

    // This is what happens when this method's parameter is an array.
    if (is_array($food)) {

      return $this->selector($food);
    }

    // This is normal operation.
    $text  = "{\r\n";
    $text .= "  Name: '" . $food->name . "',\r\n";
    $text .= "  Children:\r\n";
    $text .= "  [\r\n";
    $text .= $this->selector($food->children);
    $text .= "  ]\r\n";
    $text .= "}\r\n";
    return $text;
  }

  protected function selector($array) {
    $text = '';
    foreach ($array as $food) {
      if ($food instanceof BasicFood) {
        $text .= $this->buildBasicFood($food);
      } else if ($food instanceof CompositeFood) {
        $text .= $this->buildCompositeFood($food);
      }
    }

    return $text;
  }

  public function getResult() {
    return $this->text;
  }
}

echo "Hello world";
$f = new BasicFood();
$f->name = 'Pineapple';
$a = array(new Calorie());
$f->setNutritionFacts($a);

$arrayOfFood = array($f);
$builder = new JsonBuilder();
$builder->construct($arrayOfFood);
$builder->buildBasicFood();
echo '<pre>';
echo $builder->getResult();
?>
