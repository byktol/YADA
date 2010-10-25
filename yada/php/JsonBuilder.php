<?php
require_once("config.php");

require_once("Builder.php");
require_once("BasicFood.php");
require_once("CompositeFood.php");
require_once("NutritionFact.php");

class JsonBuilder implements Builder {

  private $text = "";
  private $arrayOfFood;

  public function __construct($arrayOfFood) {
    $this->arrayOfFood = $arrayOfFood;
  }

  public function buildBasicFood($food = null) {
    if ($food == null) {

      $count = count($this->arrayOfFood);
      for ($i = 0; $i < $count; $i++) {
        $food = $this->arrayOfFood[$i];
        if ($food instanceof BasicFood) {
          $this->text .= $this->buildBasicFood($food);

          if ($i < $count-1) {
            $this->text .= ",\r\n";
          }
        }//endif

      }// endforeach
      return;
    }//endif

    $text  = "{\r\n";
    $text .= "  \"Name\": \"". $food->getName(). "\",\r\n";
    $text .= "  \"Id\": \"". $food->getId() . "\",\r\n";
    $text .= "  \"Enabled\": \"". ($food->getEnabled()?1:0) . "\",\r\n";
    $text .= "  \"Keywords\":\r\n";
    $text .= "  [\r\n";
    $text .= $this->buildKeywordsFor($food) . "\r\n";
    $text .= "  ],\r\n";
    $text .= "  \"NutritionFacts\":\r\n";
    $text .= "  [\r\n";
    $text .= $this->buildNutritionFactsFor($food);
    $text .= "  ]\r\n";
    $text .= "}\r\n";
    return $text;
  }

  protected function buildNutritionFactsFor($food) {
    $text = "";

    $arrayOfFacts = $food->getNutritionFacts(true);
    $count = count($arrayOfFacts);
    for ($i = 0; $i < $count ; $i++) {
      $text .= $this->buildNutritionFact($arrayOfFacts[$i]);

      if ($i < $count-1) {
        $text .= "  ,\r\n";
      }
    }

    return $text;
  }

  protected function buildNutritionFact($fact) {
    $text  = "  {\r\n";
    $text .= "    \"Name\": \"". $fact->getName() . "\",\r\n";
    $text .= "    \"Quantity\": \"" . $fact->getValue() . "\"\r\n";
    $text .= "  }\r\n";
    return $text;
  }

  public function buildCompositeFood($food = null) {
    //This is what happens when this method is invoked with no parameters
    if ($food == null) {

      $count = count($this->arrayOfFood);
      for ($i = 0; $i < $count; $i++) {
        $food = $this->arrayOfFood[$i];
        if ($food instanceof CompositeFood) {
          $this->text .= $this->buildCompositeFood($food);

          if ($i < $count-1) {
            $this->text .= ",\r\n";
          }
        }
      }

      return;
    }//endif

    // This is what happens when this method"s parameter is an array.
    if (is_array($food)) {

      return $this->compositeBuild($food);
    }

    // This is normal operation.
    $text  = "{\r\n";
    $text .= "  \"Name\": \"" . $food->getName() . "\",\r\n";
    $text .= "  \"Id\": \"". $food->getId() . "\",\r\n";
    $text .= "  \"Enabled\": \"". ($food->getEnabled()?1:0) . "\",\r\n";
    $text .= "  \"Keywords\":\r\n";
    $text .= "  [\r\n";
    $text .= $this->buildKeywordsFor($food) . "\r\n";
    $text .= "  ],\r\n";
    $text .= "  \"Children\":\r\n";
    $text .= "  [\r\n";
    $text .= $this->compositeBuild($food->getChildren());
    $text .= "  ]\r\n";
    $text .= "}\r\n";
    return $text;
  }

  protected function compositeBuild($array) {
    $text = "";
    $count = count($array);
    for( $i = 0; $i < $count; $i++ ) {
      $food = $array[$i];
      $text .= "    \"" . $food->getId() . "\"\r\n";

      if ($i < $count-1) {
        $text .= ",\r\n";
      }
    }

    return $text;
  }
  
  protected function buildKeywordsFor($food)
  {
    $text = "";
    
    $keywords = $food->getKeywords();
    $count = count($keywords);
    for ($i = 0; $i < $count ; $i++) {
      $text .= "\"" . $keywords[$i] . "\"";

      if ($i < $count-1) {
        $text .= "  ,\r\n";
      }
    }
    return $text;
  }
  
  public function getResult() {
    return "[\r\n" . $this->text . "]";
  }
}
?>
