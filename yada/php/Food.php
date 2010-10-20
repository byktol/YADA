<?php
require_once 'config.php';

// A simple data type that abstracts a food
abstract class Food
{
	// The name of this food
	private $name;
	// The nutrition facts for this food
	private $facts;

	// Constructs a new instance of the Food class
	function __construct($name)
	{
		$this->setName($name);
	}
	
	// Gets the name of the food
	public function getName()
	{
		return $this->name;
	}
	
	// Sets the name of the food
	public function setName($name)
	{
		$this->name = $name;
	}
	
	// Gets the nutrition facts for this food
	public function getNutritionFacts()
	{
		return $this->facts;
	}
	
	// Sets the nutrition facts for this food
	public function setNutritionFacts($facts)
	{
		$this->facts = $facts;
	}
}
?>
