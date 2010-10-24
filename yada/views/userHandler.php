<?php

include_once 'autoload.php';
require_once(BASE . 'controller_funcs.php');

$task = $_POST['task'];

switch ($task) {

    case 'login':
        $username = $_POST['user_name'];
        $password = $_POST['password'];

        $isValid = validateLogin($username, $password);
        if ($isValid) {
            $sessMgr->set('is_logged_in', TRUE);
            $sessMgr->set('user_name', $username);

            /*
             * if the user has already registered redirect to the profile page
             * else to the registration page
             */
            if (userExists($username)) {
                $utils->redirect('profile.php');
            } else {
                $utils->redirect('register.php');
            }
        } else {
            $sessMgr->set('is_logged_in', FALSE);
            $sessMgr->set('old_user_name', $_POST['user_name']);
            $utils->redirect('login.php');
        }
        break;
    case 'save_profile':
        $data = array(
            'user_name' => $sessMgr->get('user_name'),
            'gender' => $_POST['gender'],
            'height' => $_POST['height'],
            'age' => $_POST['age'],
            'weight' => $_POST['weight'],
            'actLel' => $_POST['activity_level'],
            'calCalMethod' => $_POST['cal_calc_method']);
        //$utils->debug($data);
        $isProfileSaved = saveProfile($data);
        if ($isProfileSaved) {
            $sessMgr->set('is_profile_saved', TRUE);
        } else {
            $sessMgr->set('is_profile_saved', FALSE);
        }
        $utils->redirect('profile.php');

        break;

    default:
        echo "No task to handle!";
}
?>
