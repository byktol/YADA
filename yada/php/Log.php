<?php

class Log {

    private $date;
    private $arrConsumption = array(); // Consumption class

    public function Log() {

    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date='') {
        $this->date = ($date == '') ? date('yyyy-mm-dd') : $date;
    }

    // Array of consumptions
    public function setConsumption($consumption) {
        $this->arrConsumption = $consumption;
    }

    public function getConsumption() {
        return $this->arrConsumption;
    }

    public function toArray() {
        $arr = array();
        for ($i = 0; $i < count($this->arrConsumption); $i++) {
            $conArr = array("food_id" => $this->arrConsumption[$i]->getFood()->getId(), "qty" => $this->arrConsumption[$i]->getQuantity());
            array_push($arr, $conArr);
        }
        return array('date' => $this->date, 'consumption' => $arr);
    }

}

?>
