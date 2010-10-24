<?php

class HarrisBenedictCalculator extends CalorieCalculator {

    const MALE_CONSTANT = 66.4730;
    const FEMALE_CONSTANT = 655.0955;

    public function doCalculateBMR(User $user) {
        $w = $user->getWeight();  // in kg
        $h = $user->getHeight();  // in cm
        $a = $user->getAge();     // in years

        if ($user->getGender() == 1) {
            $bmr = 13.7516 * $w + 5.0033 * $h + 6.7550 * $a + self::MALE_CONSTANT;
        } else if ($user->getGender() == 0) {
            $bmr = 9.5634 * $w + 1.8496 * $h + 4.6756 * $a + self::FEMALE_CONSTANT;
        }

        return $bmr;
    }

}

?>
