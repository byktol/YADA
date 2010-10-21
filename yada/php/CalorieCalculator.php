<?php
require_once('config.php');

class CalorieCalculator {

    private $stategy;

    public function CalorieCalculator(CalorieCalculationStrategy $strategy) {
        $this->stategy = $strategy;
    }

    public function getCalories(CalorieMetrics $calMetrics) {
        $this->stategy->calculateCalories($calMetrics);
    }

}

?>
