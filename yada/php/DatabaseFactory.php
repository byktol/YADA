<?php

class DatabaseFactory {

    private static $instance;

    private function DatabaseFactory() {
        
    }

    public static function getInstance() {
        return (is_null(self::$instance)) ? new DatabaseFactory() : self::$instance;
    }

    public function getDatabaseByType($type) {
        if (strtolower($type) == 'json') {
            return JSONDatabase::getInstance();
        }
    }

}

?>
