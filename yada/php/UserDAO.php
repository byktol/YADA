<?php

class UserDAO extends BaseDAO {

    public function getUser($filePath) {
        $arrUser = $this->loadFromFile($filePath);
        
        $arrUser = $arrUser[0];
        echo '<pre>';
        print_r($arrUser);
        $arrUser->name;
        exit;
        
        $user = new User();
        $user->setName($arrUser->name);
        

        $calMetric = new CalorieMetrics();
        $calMetric->setAge($arrUser['age']);
        $calMetric->setGender($arrUser['gender']);
        $calMetric->setWeight($arrUser['weight']);
        $calMetric->setHeight($arrUser['height']);
        $calMetric->setActivityLevel($arrUser['act_level_id']);
        $calMetric->setCalorieCalcTpl(new HarrisBenedictTemplate());

        $user->setCalorieMetrics($calMetric);

        return $user;
    }

}

?>
