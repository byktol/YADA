<?php
require_once('config.php');

interface CalorieCalculationStrategy {

    public function calculateCalories(CalorieMetrics $calMetrics);
}

?>
