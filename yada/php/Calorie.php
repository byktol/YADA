<?php
/**
 * Represents the calories a food has.
 */
class Calorie implements NutritionFact {
  const Name = 'Calorie';
  public $quantity = 0;

  public function getName() {
    return "Calorie";
  }

  public function getQuantity() {
    return $this->quantity;
  }
}
?>
