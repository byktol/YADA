<?php

abstract class CalorieCalcTemplate {

    public function calculateNutritionFact(CalorieMetrics $calMetrics) {
        return $this->doCalculateBMR($calMetrics) * $calMetrics->getActivityLevel();
    }

    abstract protected function doCalculateBMR(CalorieMetrics $calMetrics);
}

?>
