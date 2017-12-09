<?php

require_once('./class/champ.php');
require_once('./services/UtilConexion.php');
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['champ'])) {
        try {
            UtilConexion::getInstance();
            $champ = new champ();
            $champion = $_GET['champ'];
            $lan = $_GET['lan'];
            $arr = $champ->getCounters($champion,$lan);
        } catch (Exception $ex) {
            $arr = '{"messages": [{"text": "Connection do not exist"}]}';
        }
    } else {
        $arr = '{"messages": [{"text": "Select a champ"}]}';
    }
    header('Content-type: application/json');
    echo $arr; // {"a":1,"b":2,"c":3,"d":4,"e":5}
}
