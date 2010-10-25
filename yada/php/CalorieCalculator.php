<?php

abstract class CalorieCalculator {

    public function calculateCalories(User $user) {
        return $this->doCalculateBMR($user) * $user->getActivityLevel();
    }

    abstract protected function doCalculateBMR(User $user);
}

?>
