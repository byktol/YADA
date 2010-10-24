<?php

/**
 * Description of FoodController
 */
class FoodController {
  protected static $instance;

  private function __construct() { }

  public static function getInstance() {
    if ( !isset(FoodController::$instance) ) {
      FoodController::$instance = new FoodController();
    }
    return FoodController::$instance;
  }

  public function list_food() {
    include ('views/foodEntry.php');
  }

}
?>
