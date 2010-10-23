<?php
require_once('config.php');

interface CalorieCalculationStrategy {

    public function calculateNutrition(CalorieMetrics $calMetrics);
}

?>
