<?php

require_once('./class/porok.php');
require_once('./services/UtilConexion.php');
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    try {
        UtilConexion::getInstance();
        $porok = new porok();
        $arr = $porok->speak();
    } catch (Exception $ex) {
        $arr = '{"messages": [{"text": "Connection do not exist"}]}';
    }

    header('Content-type: application/json');
    echo $arr; // {"a":1,"b":2,"c":3,"d":4,"e":5}
}
