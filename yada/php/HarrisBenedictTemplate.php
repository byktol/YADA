<?php

class HarrisBenedictTemplate extends CalorieCalcTemplate {

    private $MALE_CONSTANT = 66.4730;
    private $FEMALE_CONSTANT = 655.0955;

    public function doCalculateBMR(User $user) {
        $w = $user->getWeight();  // in kg
        $h = $user->getHeight();  // in cm
        $a = $user->getAge();     // in years

        if ($user->getGender() == 'MALE') {
            $bmr = 13.7516 * $w + 5.0033 * $h + 6.7550 * $a + $this->MALE_CONSTANT;
        } else if ($user->getGender() == 'FEMALE') {
            $bmr = 9.5634 * $w + 1.8496 * $h + 4.6756 * $a + $this->FEMALE_CONSTANT;
        }

        return $bmr;
    }

}

?>
