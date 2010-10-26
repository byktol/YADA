<?php

/**
 * Description of CalorieCalculatorEnum
 */
class CalorieCalculatorEnum {
    const HarrisBenedict = 1;
    const MifflinJerror = 2;

    public static function values() {
        return array(self::HarrisBenedict, self::MifflinJerror);
    }

}

?>
