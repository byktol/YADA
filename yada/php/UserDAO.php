<?php

class UserDAO extends BaseDAO {

    public function getUser($username) {
        $filePath = DATA . $username . '/profile.json';
        $arrUser = $this->loadFromFile($filePath);
        
        $user = new User();
        $user->setUsername($arrUser->username);

        $calMetric = new CalorieMetrics();
        $calMetric->setAge($arrUser->age);
        $calMetric->setGender($arrUser->gender);
        $calMetric->setWeight($arrUser->weight);
        $calMetric->setHeight($arrUser->height);
        $calMetric->setActivityLevel($arrUser->activity_level_id);
        $calMetric->setCalorieCalcTpl(new HarrisBenedictTemplate());

        $user->setCalorieMetrics($calMetric);

        return $user;
    }

    public function save($user) {
      $filePath = DATA . $user->getUsername() . '/profile.json';
      $isSaved = FALSE;

      if (!is_null($user->getCalorieMetrics())) {
        $calcMetrics = $user->getCalorieMetrics();
        $data['gender'] = $calcMetrics->getGender();
        $data['age'] = $calcMetrics->getGender();
        $data['height'] = $calcMetrics->getHeight();
        $data['weight'] = $calcMetrics->getWeight();
        $data['activity_level_id'] = $calcMetrics->getActivityLevel();
        $data['cal_cal_sttgy_id'] = $calcMetrics->getCalorieCalcStrategy();
      }
      $data['username'] = $user->getUsername();
      $data['password'] = $user->getPassword();

      $jsonData = json_encode($data);
      $file = fopen($filePath, 'w');

      $data = json_encode($data);

      $json = '{
            "username" : "Abhishek Shrestha",
            "firstname" : "",
            "lastname" : "",
            "gender" : "MALE",
            "age" : "25",
            "height" : "160",
            "weight" : "55",
            "activity_level_id" : "1",
            "cal_calc_sttgy_id" : "1"
        }';


      if (fwrite($file, $data)) {
          $isSaved = TRUE;
      }

      fclose($file);
      return $isSaved;
    }
}

?>
