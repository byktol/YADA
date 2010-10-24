<?php

/**
 * The caretaker of the memento design pattern.
 * Hold a list of memento objets and is reponsible for managing them.
 */
class FoodCareTaker {
  private $mementos;
  private $instance;

  private function  __construct() {
    $this->mementos = array();
  }

  public static function getInstance() {
    if (FoodCareTaker::$instance == null) {
      FoodCareTaker::$instance = new FoodCareTaker();
    }
    return FoodCareTaker::$instance;
  }
}
?>
