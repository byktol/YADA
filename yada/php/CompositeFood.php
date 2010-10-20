<?php
require_once 'config.php';

require_once('Food.php');
require_once('NutritionFactFactory');

// A food that is composed of other foods
class CompositeFood extends Food
{
	// The foods that make up this composite food
	private $children;
	
	// Constructs a new instance of the CompositeFood class
	function __construct($name)
	{
		parent::__construct($name);
		$this->children = array();
	}
	
	// Gets the foods that this food is composed of
	public function getChildren()
	{
		return $this->children;
	}
	
	// Sets the foods that compose this food
	public function setChildren($children)
	{
		$this->children = $children;
	}

	// Gets the nutrition facts for this food
	public function getNutritionFacts()
	{
		$children = $this->getChildren();
		$totalNutritionFacts = array();
		$ret = array();
		// For each child
		for($i=0;$i<count($children);$i++)
		{
			$nutritionFacts = $children[$i]->getNutritionFacts
			// For each nutrition fact
			for($j=0;$j<count($nutritionFacts);$j++)
			{
				$totalNutritionFacts[$nutritionFacts[$j]->getName()] += $nutritionFacts[$j]->getValue()
			}
		}
		
		$names = array_keys($totalNutritionFacts);
		// For each nutrition fact
		for($i=0;$i<count($names);$i++)
		{
			array_push($ret, NutritionFactFactory->create($names[$i], $totalNutritionFacts[$names[$i]]);
		}
	}
	
	// Sets the nutrition facts for this food
	public function setNutritionFacts()
	{
		throw new Exception("Cannot set nutrition facts for composite food");
	}
}
?>
