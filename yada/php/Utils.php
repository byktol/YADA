<?php

/**
 * Description of Utils
 *
 * @author Abhishek <shresthabhishek@gmail.com>
 * @since May 16, 2010 8:50:29 PM
 * @package
 */
class Utils {

    private $checkNL2BR = false;
    private $checkStripTags = false;
    private $checkEscapeString = false;
    private static $instance = NULL;

    private function Utils() {
        
    }

    public function getInstance() {
        return (is_null(self::$instance)) ? new Utils() : self::$instance;
    }

    public function optimizeImage($imgPath, $width='', $height='', $makeSquare = FALSE) {
        $src = '';
        if (!empty($imgPath)) {
            $w = !empty($width) ? '&width=' . $width : '';
            $h = !empty($height) ? '&height=' . $height : '';
            $src = IMAGER . $imgPath . $w . $h;

            if ($makeSquare) {
                $src .= '&cropratio=1:1';
            }
            $src = ' src="' . $src . '" ';
        }
        return $src;
    }

    public function getInvalidIdMessage($entity, $id) {
        $msg .= '<h4>So such <b>' . $entity . '</b> exists! May be you are tampering with the id. You provided id#: ' . htmlentities($_GET['id']) . '</h4>';
        $msg .= '<h5>Or if you are attempting for hack, you\'ve come to a wrong place! :)</h5>';
        return $msg;
    }

    /*
     * @params binVal=> pass a binary code,each digit activates a method to call or not, 1 being true and 0 false;
     * and process by another method sanitizeMethods;
     * Eg: 010 indicates perform striptags on input data but not nl2br and escape string
     */

    public function sanitize(core_MySQLManager $dbMgr, $arr, $binVal='111') {
        $ALLOWED_TAGS = '<a><b><i>';

        //enable what sanitize methods to check
        $this->sanitizeMethods($binVal);

        foreach ($arr as $key => $val) {
            //if the value is another array, the function's gonna act like recursive function
            if (is_array($arr[$key]) && !empty($arr[$key])) {
                $this->sanitize($dbMgr, $arr[$key], $binVal);
            } else {
                switch (gettype($val)) {
                    case 'string':
                        if ($this->checkNL2BR) {
                            $arr[$key] = nl2br($val);
                        }
                        if ($this->checkStripTags) {
                            $arr[$key] = strip_tags($val, $ALLOWED_TAGS);
                        }
                        if ($this->checkEscapeString) {
                            $arr[$key] = $dbMgr->escapeString($val);
                        }
                        break;
                    case 'NULL':
                        if ($this->checkEscapeString) {
                            $arr[$key] = $dbMgr->escapeString('');
                        }
                        break;
                    default:
                        if ($this->checkEscapeString) {
                            $arr[$key] = $dbMgr->escapeString($val);
                        }
                }
            }
        }
        return $arr;
    }

    private function sanitizeMethods($binVal) {
        $strValue = str_split($binVal);
        $strCount = count($strValue);
        foreach ($strValue as $key => $value) {
            if ($strValue[$key] && $strCount > $key) {
                if ($strValue[$key] == 1 && $key == 0) {
                    $this->checkNL2BR = true;
                } else if ($strValue[$key] == 1 && $key == 1) {
                    $this->checkStripTags = true;
                } else if ($strValue[$key] == 1 && $key == 2) {
                    $this->checkEscapeString = true;
                }
            } else {
                break;
            }
        }
    }

    public function makeDisplaySafe($arr) {
        foreach ($arr as $key => $val) {
            //if the value is another array, the function's gonna act like recursive function
            if (is_array($arr[$key]) && !empty($arr[$key])) {
                $this->makeDisplaySafe($arr[$key]);
            } else {
                $arr[$key] = htmlentities($val, ENT_QUOTES);
            }
        }
        return $arr;
    }

    public function getCombo(core_Collection $objColl, $defaultSel = 0) {
        $options = '';

        while ($row = $objColl->current()) {
            $id = $row->getId();
            $value = $row->getName();

            $options .='<option value="' . $id . '"';
            //multiple selection handled by passing values in an array
            if (is_array($defaultSel) && sizeof($defaultSel) > 0) {
                if (in_array($id, $defaultSel)) {
                    $options .=' selected="selected" ';
                }
            } else { //single selection of the values
                if ($id == $defaultSel && $defaultSel != '') {
                    $options .=' selected="selected" ';
                }
            }

            $options .='>' . $value . '</option>';
            $objColl->next();
        }
        return $options;
    }

    public function getTimeStamp() {
        // set the time zone to that of Nepal
        date_default_timezone_set("Asia/Katmandu");
        $time = mktime();
        $timeStamp = strftime('%c', $time);

        return $timeStamp;
    }

    public function isFormAuthentic($token) {

    }

    public function isXHR() {
        return (isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"] == 'XMLHttpRequest');
    }

    public function getCleanURI($uri) {
        // stuff spaces with hyphen and remove all character othert than alphanumeric, dot or hyphen
        return strtolower(preg_replace('/[^A-Za-z0-9.\-]/', '', str_replace(' ', '-', $uri)));
    }

    public function isInteger($val) {
        // return false if any occurrence of non integer character
        return preg_match('/[^\d]/', $num) > 0 ? FALSE : TRUE;
    }

    public function dynamicContent($replace, $replaceWith, $phrase) {
        $body = str_replace($replace, $replaceWith, $phrase);
        return $body;
    }

    public function jsonify($arr) {
        return json_encode($arr);
    }

    public function numberFormat($number, $decimals=2) {
        return number_format($number, $decimals, '.', '');
    }

    public function doSaltedMD5($value) {
        return md5($value . APPS_SALT);
    }

    public function isAuthorized($entity_id, $action_id) {
        $userObj = new apps_UserMapper();
        return $userObj->hasPrivilege(core_SessionManager::get('login_id'), $entity_id, $action_id);
    }

    public function hasEntity($entity_id) {
        $userObj = new apps_UserMapper();
        return $userObj->hasEntityPrivilege(core_SessionManager::get('login_id'), $entity_id);
    }

    /*
     * return an anchor link
     */

    public function hasEntityPrivelege($entity_id, $action_id, $title, $link) {
        if ($this->isAuthorized($entity_id, $action_id)) {
            return '<a href="' . $link . '">' . $title . '</a>';
        }
    }

    public function redirect($location='') {
        header('Location: ' . HOST . $location);
//        exit();
    }

    public function debug($arr) {
        echo '<pre>' . print_r($arr) . '</pre>';
    }

    public function displayError($msg) {
        return '<div class=""error">' . $msg . '</div>';
    }

    public function displaySuccess($msg) {
        return '<div class=""success">' . $msg . '</div>';
    }

    public function decodeJSON($json) {
        return json_decode($json, 1);
    }

    public function encodeJSON($arr) {
        return json_encode($arr);
    }

    public function readFile(){
        
    }

}

?>