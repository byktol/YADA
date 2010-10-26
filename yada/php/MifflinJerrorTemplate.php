<?php

class MifflinJerrorTemplate extends CalorieCalcTemplate {

    private $MALE_CONSTANT = 5;
    private $FEMALE_CONSTANT = -161;

    public function doCalculateBMR(User $user) {
        $w = $user->getWeight();  // in kg
        $h = $user->getHeight();  // in cm
        $a = $user->getAge();     // in years

        $bmr = 10 * $w + 6.25 * $h + 5 * $a;

        if ($user->getGender() == 'MALE') {
            $bmr += $this->MALE_CONSTANT;
        } else if ($user->getGender() == 'FEMALE') {
            $bmr -= $this->FEMALE_CONSTANT;
        }

        return $bmr;
    }

}

?>
