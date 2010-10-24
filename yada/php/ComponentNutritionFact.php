<?php

/**
 * the component interface for selectiing which nutrition fact to consider for calulation
 */
interface ComponentNutritionFact {
    public function calculateNutrition();

    public function getChildren();

    public function setChildren(ComponentNutritionFact $children);
}

?>
