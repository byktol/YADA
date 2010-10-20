<?php
require_once 'config.php';

include 'NutritionFact.php'

// A factory to create nutrition facts
class NutritionFactFactory
{
	// Creates a new NutritionFact instance and returns it
	// TODO: add support for all nutrition facts
	public static function create($name, $value)
	{
		switch($name)
		{
			case "calories":
				return new Calorie($value);
				break;
			case "vitamins":
				break;
			default:
				break;
		}
	}
}
?>