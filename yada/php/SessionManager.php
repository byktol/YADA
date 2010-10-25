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

    private function __construct() { }

    public static function getInstance() {
        if (is_null(self::$instance)){
          self::$instance = new SessionManager();
        }
        return self::$instance;
    }

    public function isLoggedIn() {
      return !is_null($this->get('user'));
    }

    public function setUser($user) {
      $this->set('user', $user);
    }

    public function getUser() {
      return $this->get('user');
    }
    
    public function getFoodData() {
      return $this->get('FOOD_DATA');
    }
    
    public function setFoodData($foodData) {
      $this->set('FOOD_DATA', $foodData);
    }

    private function get($key) {
        return isset($_SESSION[PROJECT_CODE][$key]) ? $_SESSION[PROJECT_CODE][$key] : NULL;
    }

    private function set($key, $value) {
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

    public function getUndoStack() {
      $undoStack = $this->get('undoStack');
      if (is_null($undoStack)) {
        $undoStack = array();
      }
      return $undoStack;
    }

    public function setUndoStack($undoStack) {
      $this->set('undoStack', $undoStack);
    }

    public function setRedoStack($redoStack) {
      $this->set('redoStack', $redoStack);
    }

    public function getRedoStack() {
      $redoStack = $this->get('redoStack');
      if (is_null($redoStack)) {
        $redoStack = array();
      }
      return $redoStack;
    }

    public function getCurrentUndo() {
      return $this->get('currentUndo');
    }

    public function setCurrentUndo(Memento $m) {
      return $this->set('currentUndo', $m);
    }

    private function flash($type) {
      $r = null;
      switch($type) {
        case 'errors' :
          $r = $this->get('errors');
          $this->set('errors', array());
          break;
        case 'warnings' :
          $r = $this->get('warnings');
          $this->set('warnings', array());
          break;
        case 'infos' :
          $r = $this->get('infos');
          $this->set('infos', array());
          break;
      }
      return $r;
    }

    public function error($error) {
      $e = $this->get('errors');
      $e[] = $error;
      $this->set('errors', $e);
    }

    public function warn($warning) {
      $w = $this->get('warnings');
      $w[] = $warning;
      $this->set('warnings', $w);
    }

    public function info($info) {
      $i = $this->get('infos');
      $i[] = $info;
      $this->set('infos', $i);
    }

    public function getErrors() {
      return $this->flash('errors');
    }

    public function getInfos() {
      return $this->flash('infos');
    }

    public function getWarnings() {
      return $this->flash('warnings');
    }

    public function errorCount() {
      return count($this->get('errors'));
    }

    public function warningCount() {
      return count($this->get('errors'));
    }

    public function infoCount() {
      return count($this->get('infos'));
    }
}

?>