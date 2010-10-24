<?php

require_once 'config.php';

//require_once 'FoodReader.php'; // TODO: whatever file will be reading foods
require_once 'Food.php';
require_once 'NutritionFactFactory.php';

FoodData::getPopulatedFoodData('test_json.json');

// Holds all the foods from our database
class FoodData implements MementoOriginator {

// The collection of all the foods
    private $foods = array();

// Constructs a new instance of the FoodData class
    function __construct() {
// TODO: get all the foods from our database and store them
    }

// Gets the collection of foods
    public function getFoods() {
        return $this->foods;
    }

// Sets the collection of foods
    public function setFoods($foods) {
        $this->foods = $foods;
    }

// Adds the given food to the collection
    public function addFood($food) {
        array_push($this->foods, $food);
    }

// Removes the given food from the collection
    public function removeFood($food) {
        $newFoods = array();
// Loop through the old collection and keep the ones that don't match given food
        for ($i = 0; $i < count($this->foods); $i++)
            if ($this->foods[$i] != $food)
                array_push($newFoods, $this->foods[$i]);
        $this->foods = $newFoods;
    }

// Sums all of the values of the given nutrition fact and returns the sum
    public function getSummedNutritionFact($nameOfNutritionFact) {
        $sum = 0;
        for ($i = 0; $i < count($this->foods); $i++) {
            $nutritionFacts = $this->foods[$i]->getNutritionFacts();
            for ($j = 0; $j < count($nutritionFacts); $j++) {
                if ($nutritionFacts[$j]->getName() == $nameOfNutritionFact) {
                    $sum += $nutritionFacts[$j]->getValue();
                }
            }
        }
    }

    public static function getPopulatedFoodData($filename) {
        $foodData = new FoodData();
        $fileContents = file_get_contents($filename);
        if (empty($fileContents) || $fileContents === false) {
            echo "Could not read $filename";
            return null;
        }
        $data = json_decode($fileContents);
        for ($i = 0; count($data); $i++) {
            createFood($data[$i]);
        }
    }

    public static function createFood($foodData) {
// If the food is a composite food
        if (!empty($foodData['Children'])) {
            $c = new CompositeFood($foodData['Name']);
            $foodArr = array();
// Loop through the children and add them to this composite
            for ($i = 0; $i < count($foodData['Children']); $i++) {
// Recurse
                array_push($foodArr, createFood($foodData['Children'][$i]));
            }
            $c->setChildren($foodArr);
        } else {
            $b = new BasicFood($foodData['Name']);
            $nutritionFactsArr = array();
// Loop through the nutrition facts and add them to the basic food
            for ($i = 0; $i < count($foodData['NutritionFacts']); $i++) {
                $nutFact = NutritionFactFactory::create($foodData['NutritionFacts'][$i]['Name'], $foodData['NutritionFacts'][$i]['Quantity']);
                array_push($nutritionFactsArr, $nutFact);
            }
            $b->setNutritionFacts($nutritionFactsArr);
        }
    }

}
?>