<?php

class Consumption {

    private $food; // Component food
    private $qty; // double

    public function Consumption($food='', $qty='') {
        $this->food = $food;
        $this->qty = $qty;
    }

    public function getFood() {
        return $this->food;
    }

    public function setFood($food) {
        $this->food = $food;
    }

    public function getQuantity() {
        return $this->qty;
    }

    public function setQuantity($qty) {
        $this->qty = $qty;
    }

}

?>
