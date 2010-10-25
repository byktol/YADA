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
        if (!is_file($logPath))
            return null;
        $db = JSONDatabase::getInstance();

        return $db->getData($logPath);
    }

    public function saveLog($username, Log $log) {
        // first read the whole of the log
        $arrExsitingLog = $this->getLog($username);
        if (!is_array($arrExsitingLog))
            $arrExsitingLog = $log->toArray();
        else
            array_push($arrExsitingLog, $log->toArray());

        $db = JSONDatabase::getInstance();

        $filepath = DATA . '/' . $username . '/log.json';
        if (!is_file($filepath)) {
            $f = fopen($filepath, 'w');
            fclose($f);
        }
        return $db->saveData($filepath, $arrExsitingLog);
    }

    public function updateLog($username, Log $log) {
        // first read the whole of the log
        $arrExsitingLog = $this->getLog($username);
        $logDate = $log->getDate();

        $newLog = array();
        $filePath = DATA . '/' . $username . '/log.json';

        // find the key i.e. the date on which the log is to be changed
        foreach ($arrExsitingLog as $oldLog) {
            if ($oldLog['date'] == $logDate) { // we've found the log to change                
                $newLog[] = $log->toArray();
            } else {
                $newLog[] = $oldLog;
            }
        }

        $db = JSONDatabase::getInstance();
        return $db->saveData($filePath, $newLog);
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
                

                // we have our Log so just get out!
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

    public function delConsumption($date, $consumpFoodId, $username, $foodData) {
        $log = $this->getLogByDate($username, $date, $foodData);

        $arrConsumptions = $log->getConsumption();
        $arrRemComsmp = array();
        // get all the consumption
        foreach ($arrConsumptions as $cnsmp) {

            // lets jus store everything but the one with the supplied id
            if ($cnsmp->getFood()->getId() != $consumpFoodId) {
                $arrRemComsmp[] = $cnsmp;
            }
        }
        $newLog = new Log();
        $newLog->setDate($date);
        $newLog->setConsumption($arrRemComsmp);

        $this->updateLog($username, $newLog);
    }

}

?>
