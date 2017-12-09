<?php
require_once('./class/champ.php');
require_once('./services/UtilConexion.php');
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['pos'])) {
        if (isset($_GET['champion'])) {
            try {
                UtilConexion::getInstance();
                $champ = new champ();
                $champion = $_GET['champion'];
                $pos = $_GET['pos'];
                $arr = $champ->getCounters($champion, $pos);                
            } catch (Exception $ex) {
                $arr = '{"messages": [{"text": "Connection do not exist"}]}';
            }
        } else {
            $arr = '{"messages": [{"text": "Select a champ"}]}';
        }
    } else {
        $arr = '{"messages": [{"text": "Select a pos"}]}';
    }

    header('Content-type: application/json');
    echo $arr; // {"a":1,"b":2,"c":3,"d":4,"e":5}
}
