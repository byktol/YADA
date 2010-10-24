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
