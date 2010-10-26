<?php

/**
 * A simple factory for instantiating a specified Calorie Calculator
 */
class CalorieCalculatorFactory {

    private static $instance;

    private function __construct() {
        
    }

    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new CalorieCalculatorFactory();
        }

        return self::$instance;
    }

    public function createCalculator($cid) {
        $calculator = null;
        switch ($cid) {
            case CalorieCalculatorEnum::MifflinJerror:
                $calculator = new MifflinJerrorCalculator();
                break;

            case CalorieCalculatorEnum::HarrisBenedict:
                $calculator = new HarrisBenedictCalculator();
                break;

            default:
                $calculator = new HarrisBenedictCalculator();
        }
        return $calculator;
    }

}

?>
