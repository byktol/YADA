<?php
require_once 'config.php';

include 'FoodReader.php'; // TODO: whatever file will be reading foods
include 'Food.php';

// Holds all the foods from our database
class FoodData
{
	// The collection of all the foods
	private $foods = array();
	
	// Constructs a new instance of the FoodData class
	function __construct()
	{
		// TODO: get all the foods from our database and store them
	}
	
	// Gets the collection of foods
	public function getFoods()
	{
		return $this->foods;
	}
	
	// Sets the collection of foods
	public function setFoods($foods)
	{
		$this->foods = $foods;
	}
	
	// Adds the given food to the collection
	public function addFood($food)
	{
		array_push($this->foods, $food);
	}
	
	// Removes the given food from the collection
	public function removeFood($food)
	{
		$newFoods = array();
		// Loop through the old collection and keep the ones that don't match given food
		for($i=0;$i<count($this->foods);$i++)
			if($this->foods[$i] != $food)
				array_push($newFoods, $this->foods[$i]);
		$this->foods = $newFoods;
	}
}
?>