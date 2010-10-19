<?php
include 'NutitionFact';

// Represents a calorie
class Calorie implements NutritionFact 
{
	private const $NAME = 'Calories';

	// Constructs a new instance of the Calorie class
	function __construct($value)
	{
		parent::__construct($NAME, $value);
	}
}
?>