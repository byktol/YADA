<?php

class Consumption {

    private $food; // Component food
    private $qty; // double

    public function Consumption() {
    }

    public function getFood() {
        return $this->food;
    }

    public function setFood(Food $food) {
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
