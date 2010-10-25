<?php

class UserDAO {

    public function getUser($username) {
        $filePath = DATA . $username . '/profile.json';
        $arrUser = $this->loadFromFile($filePath);

        return $arrUser;
    }

    public function save(User $user) {
      $filePath = DATA . $user->getUsername() . '/profile.json';
      $isSaved = FALSE;

      $data['username'] = $user->getUsername();
      $data['password'] = $user->getPassword();
      $data['gender'] = $user->getGender();
      $data['age'] = $user->getGender();
      $data['height'] = $user->getHeight();
      $data['weight'] = $user->getWeight();
      $data['activity_level'] = $user->getActivityLevel();
      $data['calculator_id'] = $user->getCalculatorId();

      $jsonData = json_encode($data);
      $file = fopen($filePath, 'w');

      $data = json_encode($data);

      if (fwrite($file, $data)) {
          $isSaved = TRUE;
      }

      fclose($file);
      return $isSaved;
    }

    public function loadFromFile($filePath) {
        $fh = fopen($filePath, 'r');
        $data = fgets($fh);
        fclose($fh);
        $data = json_decode($data);

        $user = new User();
        $user->setUsername($data->username);
        $user->setPassword($data->password);

        if (isset($data->gender)) {
          $user->setGender($data->gender);
        }
        if (isset($data->age)) {
          $user->setGender($data->age);
        }
        if (isset($data->height)) {
          $user->setHeight($data->height);
        }
        if (isset($data->weight)) {
          $user->setWeight($data->weight);
        }
        if (isset($data->activity_level)) {
          $user->setActivityLevel($data->activity_level);
        }
        if (isset($data->calculator_id)) {
          $user->setCalculatorLevel($data->calculator_id);
        }

        return $user;
    }
}

?>
