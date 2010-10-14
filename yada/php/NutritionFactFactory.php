<?php
class NutritionFactFactory
{
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