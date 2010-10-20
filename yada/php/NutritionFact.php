<?php
require_once 'config.php';

// A simple data type for a nutrition fact
abstract class NutritionFact
{
	// The name of the nutrition fact
	private $name;
	// The value of the nutrition fact
	private $value;
	
	// Constructs a new instance of the NutritionFact class
	function __construct($name, value)
	{
		$this->name = $name;
		$this->value = $value;
	}
	
	// Gets the name of the nutrition fact
	public function getName()
	{
		return $this->name;
	}
	
	// Sets the name of the nutrition fact
	public function setName($name)
	{
		$this->name = $name;
	}
	
	// Gets the value of the nutrition fact
	public function getValue()
	{
		return $this->value;
	}
	
	// Sets the value of the nutrition fact
	public function setValue($value)
	{
		$this->value = $value;
	}
	
	// Returns a string representation of the NutritionFact instance
	public abstract function toString()
	{
		return null;
	}
}
?>