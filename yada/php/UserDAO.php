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
          $user->setCalculatorId($data->calculator_id);
        }

        return $user;
    }

    public function getLog($username) {
        $logPath = DATA . $username . '/log.json';
        $db = JSONDatabase::getInstance();

        return $db->getData($logPath);
    }

    public function saveLog($username, Log $log) {
        // first read the whole of the log
        $arrExsitingLog = $this->getLog($username);
        $newLog = array_push($arrExsitingLog, $log->toArray());

        $db = JSONDatabase::getInstance();

        return $db->saveData($filePath, $newLog);
    }

    public function updateLog($username, Log $log) {
        // first read the whole of the log
        $arrExsitingLog = $this->getLog($username);
        $logDate = $log->getDate();

        // find the key i.e. the date on which the log is to be changed
        foreach ($arrExsitingLog as $oldLog) {
            if ($arrExsitingLog['date'] == $logDate) { // we've found the log to change
                $arrExsitingLog['consumption'] = $log->getConsumption(); // update with the new Comsumption
            }
        }

        $db = JSONDatabase::getInstance();
        return $db->saveData($filePath, $arrExsitingLog);
    }

    public function getLogByDate($username, $date, $foodData) {
        // first read the whole of the log
        $arrExsitingLog = $this->getLog($username);
        $log = null;

        // find the key i.e. the date on which the log is to be changed
        foreach ($arrExsitingLog as $oldLog) {

            if ($oldLog['date'] == $date) { // we've found the log to change
                $log = new Log();
                $log->setDate($date);

                $dao = new DAO();

                $arrConsumptioObj = $dao->getComsumption($oldLog['consumption'], $foodData);
                $log->setConsumption($arrConsumptioObj);

                break;
            }
        }
        return $log;
    }

    /**
     * return all of the log entry if the date is provided else jus return of
     * just the single day
     * @param <type> $date
     */
    public function getAllLog($username, $foodData) {
        // first read the whole of the log
        $arrExsitingLog = $this->getLog($username);

        $arrLogs = array();
        $dao = new DAO();

        // find the key i.e. the date on which the log is to be changed
        foreach ($arrExsitingLog as $arrLog) {
        $log = new Log();
            echo $arrLog['date'];
            $log->setDate($arrLog['date']);

            $arrConsumptioObj = $dao->getComsumption($arrLog['consumption'], $foodData);
            
            $log->setConsumption($arrConsumptioObj);
            $arrLogs[] = $log;
        }
        return $arrLogs;
    }

}

?>
