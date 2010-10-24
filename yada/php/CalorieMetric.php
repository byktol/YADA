<?php

require_once('config.php');

class CalorieMetric {

    private $age;
    private $height;
    private $weight;
    private $activityLevel;
    private $calorieCalStategy;

    public function CalorieMetrics($gender, $age, $height, $weight, $activityLevel) {
        $this->setAge($age);
        $this->setGender($gender);
        $this->setHeight($height);
        $this->setWeight($weight);
        $this->setActivityLevel($activityLevel);
        $this->setCalorieCalcStrategy($calorieCalcStrategy);
    }

    public function getGender() {
        return $this->gender;
    }

    public function setGender($gender) {
        $this->gender = $gender;
    }

    public function getHeight() {
        return $this->height;
    }

    public function setHeight($height) {
        $this->height = $height;
    }

    public function getAge() {
        return $this->age;
    }

    public function setAge($age) {
        $this->age = $age;
    }

    public function getWeight() {
        return $this->weight;
    }

    public function setWeight($weight) {
        $this->weight = $weight;
    }

    public function getActivityLevel() {
        return $this->activityLevel;
    }

    public function setActivityLevel($activityLevel) {
        $this->activityLevel = $activityLevel;
    }

    public function getCalorieCalcStrategy() {
        return $this->activityLevel;
    }

    public function setCalorieCalcStrategy(CalorieCalculationStrategy $calorieCalcStrategy) {
        $this->calorieCalStategy = $calorieCalcStrategy;
    }

}

require_once 'BenedictStrategy.php';
require_once 'MiffinJerrorStrategy.php';
require_once 'CalorieCalculator.php';

$calMet = new CalorieMetrics('MALE', 25, 180, 70);

$benedict = new BenedictStrategy();
$miffin = new MiffinJerrorStrategy();

$calCalculator = new CalorieCalculator($benedict);
echo 'As per BEnedict strategy:<br/>';
echo $calCalculator->getCalories($calMet);

$calCalculator = new CalorieCalculator($miffin);
echo 'As per Miffin Jerror strategy:<br/>';
echo $calCalculator->getCalories($calMet);
?>
