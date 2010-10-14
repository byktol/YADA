<?php
abstract class Food
{
	private $facts;
	private $name;

	function __construct($name)
	{
		$this->setName($name);
	}
	
	abstract public function getName()
	{
		return $name;
	}
	abstract public function setName($name)
	{
		$this->name = $name;
	}
	
	abstract public function getNutritionFacts()
	{
		return $facts;
	}
	abstract public function setNutritionFacts($facts)
	{
		$this->facts = $facts;
	}
}
?>
