<?php

/**
 * Description of SessionManager
 *
 * @author Abhishek <shresthabhishek@gmail.com>
 * @since Jun 25, 2009 12:44:23 AM
 * @package
 */
class SessionManager {

    private static $instance;

    private function SessionManager() {
        session_start();
    }

    public function getInstance() {
        return (is_null(self::$instance)) ? new SessionManager() : self::$instance;
    }

    public function get($key) {
        return isset($_SESSION[PROJECT_CODE][$key]) ? $_SESSION[PROJECT_CODE][$key] : NULL;
    }

    public function set($key, $value) {
        $_SESSION[PROJECT_CODE][$key] = $value;
    }

    public function setCounter($key) {
        // increase the counter by 1 each time
        $ctr = isset($_SESSION[PROJECT_CODE][$key]) ? $_SESSION[PROJECT_CODE][$key] + 1 : 1;
        core_SessionManager::set($key, $ctr);
    }

    public function reset($keys = NULL) {
        if ($keys == NULL) {
            unset($_SESSION[PROJECT_CODE]);
        } else if (is_array($keys)) {
            foreach ($keys as $key) {
                unset($_SESSION[PROJECT_CODE][$key]);
            }
        } else {
            unset($_SESSION[PROJECT_CODE][$keys]);
        }
    }

    public function display() {
        echo '<pre>' . print_r($_SESSION[PROJECT_CODE]) . '</pre>';
//        return $_SESSION[PROJECT_CODE];
    }

    public function isFormAuthentic($reqToken) {
        $sessToken = core_SessionManager::get(SESS_TOKEN);
        return ($sessToken == $reqToken) ? TRUE : FALSE;
    }

    public function getToken() {
        // create a random session key and apply MD5 with salt
        $key = md5(uniqid() . APPS_SALT);
        core_SessionManager::set(SESS_TOKEN, $key);
        return $key;
    }

}

?>