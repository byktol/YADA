<?php

/**
 * The caretaker of the memento design pattern.
 * Holds a list of memento objets and is reponsible for managing them.
 */
class FoodCareTaker {

    private $mementos;
    private $instance;

    private function __construct() {
        $this->mementos = array();
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new FoodCareTaker();
        }
        return self::$instance;
    }

}

?>
