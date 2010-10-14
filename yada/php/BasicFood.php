<?php
require_once('Food.php');

class BasicFood extends Food
{
	function __construct($name)
	{
		parent::__construct($name);
	}
	
	function setNutritionFacts($nutritionFacts)
	{
		$this->nutritionFacts = $nutritionFacts;
	}
}
?>
