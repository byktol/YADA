<?php

abstract class BaseDAO {

    public function loadFromFile($filePath) {
        $json = '[{
            "name" : "Abhishek Shrestha",
            "gender" : "MALE",
            "age" : "25",
            "height" : "160",
            "weight" : "55",
            "activity_level_id" : "1",
            "cal_calc_sttgy_id" : "1"
        }]';

        return json_decode($json);
    }

}

?>
