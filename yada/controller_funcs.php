<?php

function validateLogin($username, $password) {
    $isValid = FALSE;

    $dbFactory = DatabaseFactory::getInstance();
    $db = $dbFactory->getDatabaseByType('json');

    $arrUsers = $db->getData(DATA_USERS);

    foreach ($arrUsers as $user) {
        if ($username == $user['username'] && $password == $user['password']) {
            $isValid = TRUE;
            break;
        }
    }
    return $isValid;
}

/**
 * registers a new user and writes to the database the username as the password.
 * Be sure to call the @see userExist() method prior calling
 * this method
 * @param <type> $username
 * @param <type> $password
 */
function register($username, $password) {
    $dbFactory = DatabaseFactory :: getInstance();
    $db = $dbFactory->getDatabaseByType('json');

    $arrUsers = $db->getData(DATA_USERS);
    $arrUsers[] = array('username' => $username, 'password' => $password);

    $isRegistered = $db->saveData(DATA_USERS, $arrUsers);

    if ($isRegistered) {
        // lets also crate the folder for the user under data
        $userDir = DATA . $username . '/';
        mkdir($userDir);
        fopen($userDir . 'profile.json', 'w');
        fopen($userDir . 'foods.json', 'w');
        fopen($userDir . 'log.json', 'w');
    }
    return $isRegistered;
}

/**
 * checks if the user already exists in the database
 * @param <type> $username
 * @return boolean
 */
function userExists($username) {
    $userExists = FALSE;

    $dbFactory = DatabaseFactory::getInstance();
    $db = $dbFactory->getDatabaseByType('json');

    $arrUsers = $db->getData(DATA_USERS);
    if (count($arrUsers) > 0) {
        foreach ($arrUsers as $user) {
            if ($username == $user['username']) {
                $userExists = TRUE;
                break;
            }
        }
    }
    return $userExists;
}

/* TODO: later implementation
  function saveProfile(User $user) {
  $arrProfile = array(
  "name" => user->getName(),
  "gender" => user->getGender(),
  "age" => user->getAge(),
  "height" => user->getWeight(),
  "weight" => user->getHeight(),
  "act_level_id" => user->getActLev(),
  "cal_calc_tpl_id" => user->getCalCalcMthd());
  }
 */

function saveProfile($data) {
    $arrProfile = array(
        "name" => $data['user_name'],
        "gender" => $data['gender'],
        "age" => $data['age'],
        "height" => $data['height'],
        "weight" => $data['weight'],
        "act_level_id" => $data['actLel'],
        "cal_calc_tpl_id" => $data['calCalMethod']
    );

    $dbFactory = DatabaseFactory::getInstance();
    $db = $dbFactory->getDatabaseByType('json');

    $profilePath = DATA.$data['user_name'] . '/profile.json';
    return $db->saveData($profilePath, $arrProfile);
}

?>
