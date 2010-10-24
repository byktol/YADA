<?php

require_once 'config.php';

require_once 'Food.php';
require_once 'NutritionFact.php';
require_once 'BasicFood.php';
require_once 'CompositeFood.php';
require_once 'JsonBuilder.php';

// Holds all the foods from our database
class FoodData {

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

    // Returns all the basic foods in this food data
    public function getBasicFoods() {
        $retArr = array();
        $foods = $this->getFoods();
        for ($i = 0; $i < count($foods); $i++) {
            if (!$foods[$i]->hasChildren())
                array_push($retArr, $foods[$i]);
        }
        return $retArr;
    }

    // Returns all the composite foods in this food data
    public function getCompositeFoods() {
        $retArr = array();
        $foods = $this->getFoods();
        for ($i = 0; $i < count($foods); $i++) {
            if ($foods[$i]->hasChildren())
                array_push($retArr, $foods[$i]);
        }
        return $retArr;
    }

    // Sets the collection of foods
    public function setFoods($foods) {
        $this->foods = $foods;
    }

    // Adds the given food to the collection. Note changes are not made to the file until save is called.
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

    // Saves the food database as a json format file with the given name
    public function save($filename) {
        $builder = new JsonBuilder($this->getFoods());
        $builder->buildBasicFood();
        $builder->buildCompositeFood();
        $builder->getResult();
        $f = fopen($filename, 'w');
        fwrite($f, $builder->getResult());
        fflush($f);
        fclose($f);
    }

    // Returns a fooddata object populated with the foods from the given file
    public static function getPopulatedFoodData($filename) {
        $foodData = new FoodData();
        $fileContents = file_get_contents($filename, true);
        if (empty($fileContents) || $fileContents === false) {
            echo "Could not read $filename<br>";
            return null;
        }
        $data = json_decode($fileContents, true);
        if ($data == null) {
            echo "Could not parse JSON<br>";
            return null;
        }
        for ($i = 0; $i < count($data); $i++) {
            $f = FoodData::createFood($foodData, $data[$i]);
            $foodData->addFood($f);
        }
        return $foodData;
    }

    // Creates a food from a json outputted array
    private static function createFood($foodDat, $foodData) {
        // If the food is a composite food
        if (!empty($foodData['Children'])) {
            $c = new CompositeFood($foodData['Name']);
            $c->setId($foodData['Id']);
            $c->setEnabled($foodData['Enabled']);
            $foodArr = array();
            // Loop through the children and add them to this composite
            for ($i = 0; $i < count($foodData['Children']); $i++) {
                // Find the food with the child's id. We will grab a reference to the food and store it
                $foodRef = FoodData::findFood($foodDat, $foodData['Children'][$i]);
                // If we found the food with the given id, store it
                if ($foodRef != null)
                    array_push($foodArr, $foodRef);
                // Otherwise, push an undefined food
                else
                    array_push($foodArr, BasicFood::$Undefined);
            }
            $c->setChildren($foodArr);
            return $c;
        }
        else {
            // Create a new basic food
            $b = new BasicFood($foodData['Name']);
            $b->setId($foodData['Id']);
            $b->setEnabled($foodData['Enabled']);
            $nutritionFactsArr = array();
            // Loop through the nutrition facts and add them to the basic food
            for ($i = 0; $i < count($foodData['NutritionFacts']); $i++) {
                $nutFact = new NutritionFact($foodData['NutritionFacts'][$i]['Name'], $foodData['NutritionFacts'][$i]['Quantity']);
                array_push($nutritionFactsArr, $nutFact);
            }
            $b->setNutritionFacts($nutritionFactsArr);
            return $b;
        }
    }

    // Finds the food with the given id and returns a reference to it
    private static function findFood($foodData, $id) {
        $foods = $foodData->getFoods();
        for ($i = 0; $i < count($foods); $i++) {
            if ($foods[$i]->getId() == $id) {
                $ret = &$foods[$i];
                return $ret;
            }
        }
        return null;
    }

    public function createMemento() {
        
    }

    public function setMemento($memento) {
        
    }

}

// Simple debug script that reads 'test_json.json', parses it and outputs some debug text
if ($DEBUG && !(strpos(strtolower($_SERVER['REQUEST_URI']), 'fooddata.php') === false)) {
    $fData = FoodData::getPopulatedFoodData('test_json.json');
    $foods = $fData->getFoods();
    for ($i = 0; $i < count($foods); $i++) {
        echo $foods[$i]->toString() . '<br>';
    }
}
?>