<?php
class NutritionFact
{
	$name;
	$value;
	
	function __construct($name, value)
	{
		$this->name = $name;
		$this->value = $value;
	}
	
	public function getName()
	{
		return $name;
	}
	
	public function getValue()
	{
		return $value;
	}
}
?>