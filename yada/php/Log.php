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

    public function setConsumption($consumption) {
        $this->arrConsumption = $consumption;
    }

    public function getConsumption() {
        return $this->arrConsumption;
    }

    public function toArray() {
        return array('date' => $this->date, 'consumption' => $this->arrConsumption);
    }

}

?>
