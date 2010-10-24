<?php
require_once 'config.php';

require_once('Food.php');
require_once('NutritionFact.php');

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
	
	// Composites always have children
	public function hasChildren()
	{
		return true;
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
	public function getNutritionFacts($countDisabled)
	{
		// If the food is disabled and we don't want to count disabled foods
		if(!$this->getEnabled() && !$countDisabled)
			return array();
		$children = $this->getChildren();
		$totalNutritionFacts = array();
		$ret = array();
		// For each child
		for($i=0;$i<count($children);$i++)
		{
			if($children[$i] != BasicFood::$Undefined)
			{
				$nutritionFacts = $children[$i]->getNutritionFacts($countDisabled);
				// For each nutrition fact
				for($j=0;$j<count($nutritionFacts);$j++)
				{
					if(empty($totalNutritionFacts[$nutritionFacts[$j]->getName()]))
						$totalNutritionFacts[$nutritionFacts[$j]->getName()] = 0;
					$totalNutritionFacts[$nutritionFacts[$j]->getName()] += $nutritionFacts[$j]->getValue();
				}
			}
		}
		
		$names = array_keys($totalNutritionFacts);
		// For each nutrition fact
		for($i=0;$i<count($names);$i++)
		{
			array_push($ret, new NutritionFact($names[$i], $totalNutritionFacts[$names[$i]]));
		}
		return $ret;
	}
	
	// Sets the nutrition facts for this food
	public function setNutritionFacts()
	{
		throw new Exception("Cannot set nutrition facts for composite food");
	}
}

// Only run this debug script if we actually requested this page
if(DEBUG && !(strpos(strtolower($_SERVER['REQUEST_URI']), 'compositefood.php') === false))
{
	require_once 'JsonBuilder.php';

	function test($arrFood) {
	  $builder = new JsonBuilder($arrFood);
	  $builder->buildBasicFood();
	  $builder->buildCompositeFood();
	  echo '<pre>';
	  echo $builder->getResult();
	  $f = fopen('test_json.json', 'w');
	  fwrite($f, $builder->getResult());
	  fflush($f);
	  fclose($f);
	}
	
	require_once('BasicFood.php');
	$burger = new CompositeFood('Burger');
	$bun = new BasicFood('Bun');
	$bunFacts = array(new NutritionFact('calories', 60));
	$bun->setNutritionFacts($bunFacts);
	$bun->createUniqueId();
	echo $bun->toString().'<br>';
	$pattie = new BasicFood('Pattie');
	$pattieFacts = array(new NutritionFact('calories', 200));
	$pattie->setNutritionFacts($pattieFacts);
	$pattie->createUniqueId();
	echo $pattie->toString().'<br>';
	$lettuce = new BasicFood('Lettuce');
	$lettuceFacts = array(new NutritionFact('calories', 40));
	$lettuce->setNutritionFacts($lettuceFacts);
	$lettuce->createUniqueId();
	echo $lettuce->toString().'<br>';
	$burgerFoods = array();
	array_push($burgerFoods, $bun);
	array_push($burgerFoods, $pattie);
	array_push($burgerFoods, $lettuce);
	$burger->setChildren($burgerFoods);
	$burger->createUniqueId();
	echo $burger->toString().'<br><br>';
	$twoBurgers = new CompositeFood('TwoBurgers and a lettuce');
	$twoBurgers->setChildren(array($burger, $burger, $lettuce));
	$twoBurgers->createUniqueId();
	echo $twoBurgers->toString().'<br>';
	
	test(array($bun, $pattie, $lettuce, $burger, $twoBurgers));
}
?>
