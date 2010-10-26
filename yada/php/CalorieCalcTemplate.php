<?php

abstract class CalorieCalcTemplate {

    public function calculateNutritionFact(User $user) {
        return $this->doCalculateBMR($user) * $user->getActivityLevel();
    }

    abstract protected function doCalculateBMR(User $user);
}

?>
