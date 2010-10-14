<?php
require_once('Food.php');

class BasicFood implements Food {
  public $nutritionFacts;

  function setNutritionFacts($array) {
    $this->nutritionFacts = $array;
  }
}