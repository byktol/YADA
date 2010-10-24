<?php

/**
 * A simple factory for instantiating a specified Calorie Calculator
 */
class CalorieCalculatorFactory {
  private static $instance;

  private function __construct() { }

  public static function getInstance() {
    if (is_null(self::$instance)) {
      self::$instance = new CalorieCalculatorFactory();
    }

    return self::$instance;
  }

  public function createCalculator($cid) {
    switch ($cid) {
      case CalorieCalculatorEnum::MifflinJerror:
        return new MifflinJerrorCalculator();

      case CalorieCalculatorEnum::HarrisBenedict:
        ;
      default:
        return new HarrisBenedictCalculator();
    }
  }
}
?>
