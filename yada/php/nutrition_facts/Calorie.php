<?php
include 'NutritionFact.php';

// Represents a calorie
class Calorie extends NutritionFact
{
	const NAME = 'Calorie';

	// Constructs a new instance of the Calorie class
	public function __construct($value)
	{
		parent::__construct(Calorie::NAME, $value);
	}

  public function toString() {
    return Calorie::NAME;
  }
}
?>