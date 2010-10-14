<?php
class CompositeFood extends Food
{
	private $children;
	
	function __construct($name)
	{
		parent::__construct($name);
		$children = array();
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
	}
}