<?php

class MifflinJerrorTemplate extends CalorieCalcTemplate {

    private $MALE_CONSTANT = 5;
    private $FEMALE_CONSTANT = -161;

    public function doCalculateBMR(CalorieMetrics $calMetrics) {
        $w = $calMetrics->getWeight();  // in kg
        $h = $calMetrics->getHeight();  // in cm
        $a = $calMetrics->getAge();     // in years

        $bmr = 10 * $w + 6.25 * $h + 5 * $a;

        if ($calMetrics->getGender() == 'MALE') {
            $bmr += $this->MALE_CONSTANT;
        } else if ($calMetrics->getGender() == 'FEMALE') {
            $bmr -= $this->FEMALE_CONSTANT;
        }

        return $bmr;
    }

}

?>
