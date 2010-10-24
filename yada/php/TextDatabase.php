<?php

interface TextDatabase {

    public function getData($filePath);

    public function saveData($filePath, $data);
}

?>
