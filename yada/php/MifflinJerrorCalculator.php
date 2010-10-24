<?php

class MifflinJerrorCalculator extends CalorieCalculator {

    const MALE_CONSTANT = 5;
    const FEMALE_CONSTANT = -161;

    public function doCalculateBMR(User $user) {
        $w = $user->getWeight();  // in kg
        $h = $user->getHeight();  // in cm
        $a = $user->getAge();     // in years

        $bmr = 10 * $w + 6.25 * $h + 5 * $a;

        if ($user->getGender() == 1) {
            $bmr += $this->MALE_CONSTANT;
        } else if ($user->getGender() == 0) {
            $bmr -= $this->FEMALE_CONSTANT;
        }

        return $bmr;
    }

}

?>
