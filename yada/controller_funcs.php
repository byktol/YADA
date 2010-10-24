<?php

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
