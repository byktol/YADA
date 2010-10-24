<?php

/**
 * Description of FoodController
 */
class FoodController {
  protected static $instance;

  private function __construct() { }

  public static function getInstance() {
    if ( !isset(self::$instance) ) {
      self::$instance = new FoodController();
    }
    return self::$instance;
  }

  public function list_food() {
    include ('views/foodEntry.php');
  }

}
?>
