<?php
require_once('config.php');

require_once 'CalorieCalculationStrategy.php';

class BenedictStrategy implements CalorieCalculationStrategy {

    private $MALE_CONSTANT = 66.4730;
    private $FEMALE_CONSTANT = 655.0955;

    public function calculateNutrition(CalorieMetrics $calMetrics) {
        $w = $calMetrics->getWeight();  // in kg
        $h = $calMetrics->getHeight();  // in cm
        $a = $calMetrics->getAge();     // in years

        if ($calMetrics->getGender() == 'MALE') {
            $cal = 13.7516 * $w + 5.0033 * $h + 6.7550 * $a + $this->MALE_CONSTANT;
        } else if ($calMetrics->getGender() == 'FEMALE') {
            $cal = 9.5634 * $w + 1.8496 * $h + 4.6756 * $a + $this->FEMALE_CONSTANT;
        }

        return $cal;
    }

}

?>
