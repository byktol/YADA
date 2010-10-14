<?php
require_once('Food.php');
require_once('NutritionFactFactory');

class CompositeFood extends Food
{
	private $children;
	
	function __construct($name)
	{
		parent::__construct($name);
		$this->children = array();
	}
	
	public function getChildren()
	{
		return $children;
	}
	
	public function setChildren($children)
	{
		$this->children = $children;
	}

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
	
	public function setNutritionFacts()
	{
		throw new Exception("Cannot set nutrition facts for composite food");
	}
}
?>
