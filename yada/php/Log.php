<?php

class Log {

    private $date;
    private $arrConsumption; // Consumption class

    public function Log() {

    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date='') {
        $this->date = ($date == '') ? date('mm/dd/yyyy') : $date;
    }

    public function setConsumption($consumption) {
        $this->arrConsumption[] = array(
            'food_id' => $consumption->getFood()->getId(),
            'qty' => $consumption->getQuantity()
        );
    }

    public function getConsumption() {
        return $this->arrConsumption;
    }
}

?>
