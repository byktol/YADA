<?php
include 'FoodReader.php'; // TODO: whatever file will be reading foods

// Holds all the foods from our database
class FoodData
{
	// The collection of all the foods
	private $foods = array();
	
	function __construct()
	{
		// TODO: get all the foods from our database and store them
	}
	
	public function getFoods()
	{
		return $this->foods;
	}
	
	public function setFoods($foods)
	{
		$this->foods = $foods;
	}
}
?>