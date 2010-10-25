<?php

/**
 * Holds the state of a FoodData.
 */
class Memento {
  private $foodState;

  public function setState($state) {
    $this->foodState = $state;
  }

  public function getState() {
    return $this->foodState;
  }
}
?>
