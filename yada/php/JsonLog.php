<?php

class JsonLog implements Log {

    private $date;
    private $arrConsumption; // Consumption class

    public function JsonLog() {
        
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date='') {
        $this->date = ($date == '') ? date('mm/dd/yyyy') : $this->date;
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

    public function toString() {
        $arrJson = array('date' => $this->getDate(), 'comsumption' => $this->getConsumption());
        return json_encode($arrJson);
    }

}

?>
