<?php
require_once 'CalorieCalculationStrategy.php';

class MiffinJerrorStrategy implements CalorieCalculationStrategy {

    private $MALE_CONSTANT = 5;
    private $FEMALE_CONSTANT = -161;

    public function calculateCalories(CalorieMetrics $calMetrics) {
        $w = $calMetrics->getWeight();  // in kg
        $h = $calMetrics->getHeight();  // in cm
        $a = $calMetrics->getAge();     // in years

        $cal = 10 * $w + 6.25 * $h + 5 * $a;

        if ($calMetrics->getGender() == 'MALE') {
            $cal += $this->MALE_CONSTANT;
        } else if ($calMetrics->getGender() == 'FEMALE') {
            $cal -= $this->FEMALE_CONSTANT;
        }

        return $cal;
    }

}

?>
