<?php
require_once 'config.php';

//require_once 'FoodReader.php'; // TODO: whatever file will be reading foods
require_once 'Food.php';
require_once 'NutritionFact.php';
require_once 'BasicFood.php';
require_once 'CompositeFood.php';


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
	
	// Sums all of the values of the given nutrition fact and returns the sum
	public function getSummedNutritionFact($nameOfNutritionFact)
	{
		$sum = 0;
		for($i=0;$i<count($this->foods);$i++)
		{
			$nutritionFacts = $this->foods[$i]->getNutritionFacts();
			for($j=0;$j<count($nutritionFacts);$j++)
			{
				if($nutritionFacts[$j]->getName() == $nameOfNutritionFact)
				{
					$sum += $nutritionFacts[$j]->getValue();
				}
			}
		}
	}
	
	public static function getPopulatedFoodData($filename)
	{
		$foodData = new FoodData();
		$fileContents = file_get_contents($filename);
		if(empty($fileContents) || $fileContents === false)
		{
			echo "Could not read $filename<br>";
			return null;
		}
		echo $fileContents . '<br><br>';
		$data = json_decode($fileContents, true);
		if($data == null)
		{
			echo "Could not parse JSON<br>";
			return null;
		}
		print_r($data);
		for($i=0;$i<count($data);$i++)
		{
			$f = FoodData::createFood($foodData, $data[$i]);
			$foodData->addFood($f);
		}
		return $foodData;
	}
	
	public static function createFood($foodDat, $foodData)
	{
		// If the food is a composite food
		if(!empty($foodData['Children']))
		{
			$c = new CompositeFood($foodData['Name']);
			$c->setId($foodData['Id']);
			$c->setEnabled($foodData['Enabled']);
			$foodArr = array();
			// Loop through the children and add them to this composite
			for($i=0;$i<count($foodData['Children']);$i++)
			{
				// Recurse
				$foodRef = FoodData::findFood($foodDat, $foodData['Children'][$i]);
				if($foodRef != null)
					array_push($foodArr, $foodRef);
				else
					array_push($foodArr, BasicFood::$Undefined);
			}
			$c->setChildren($foodArr);
			return $c;
		}
		else
		{
			$b = new BasicFood($foodData['Name']);
			$b->setId($foodData['Id']);
			$b->setEnabled($foodData['Enabled']);
			$nutritionFactsArr = array();
			// Loop through the nutrition facts and add them to the basic food
			for($i=0;$i<count($foodData['NutritionFacts']);$i++)
			{
				$nutFact = new NutritionFact($foodData['NutritionFacts'][$i]['Name'], $foodData['NutritionFacts'][$i]['Quantity']);
				array_push($nutritionFactsArr, $nutFact);
			}
			$b->setNutritionFacts($nutritionFactsArr);
			return $b;
		}
	}
	
	public static function findFood($foodData, $id)
	{
		$foods = $foodData->getFoods();
		for($i=0;$i<count($foods);$i++)
		{
			if($foods[$i]->getId() == $id)
			{
				$ret = &$foods[$i];
				return $ret;
			}
		}
		return null;
	}
}

if($DEBUG)
{
	$fData = FoodData::getPopulatedFoodData('test_json.json');
	$foods = $fData->getFoods();
	for($i=0;$i<count($foods);$i++)
	{
		echo $foods[$i]->toString() . '<br>';
	}
}
?>