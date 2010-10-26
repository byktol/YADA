<?php

class DAO {

    public function getComsumption($arrCnsmp, $foodData) {
        $arrComsmp = array();
        if (count($arrCnsmp) > 0) {
            // check if array is need
            if (count($arrCnsmp['consumption']) == 1) {
                $consumption = new Consumption();
                $food = FoodData::findFood($foodData, $arrCnsmp['food_id']);

                $food->setId($arrCnsmp['food_id']);

                $consumption->setQuantity($arrCnsmp['qty']);
                $arrCnsmp = array($consumption);
            } else {
                // peudo flyweight jus set the props for the consumptions??
                foreach ($arrCnsmp as $cnsmp) {
                    $consumption = new Consumption();

                    $food = FoodData::findFood($foodData, $cnsmp['food_id']);

                    $consumption->setFood($food);
                    $consumption->setQuantity($cnsmp['qty']);

                    $arrComsmp[] = $consumption;
                }
            }
        }
        return $arrComsmp;
    }

}

?>
