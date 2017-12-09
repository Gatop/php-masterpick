<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of campeon
 *
 * @author Gatop
 */
class champ {

    function getCounters($champion, $pos) {
        if (isChamp($champion)) {
            $name = ucwords($champion);
            $acentos = UtilConexion::$pdo->query("SET NAMES 'utf8'");
            $result = UtilConexion::$pdo->query("select counters from counterpick where champion='$champion' and pos='$pos'");
            if ($result->rowCount() > 0) {
                $strjson = '{ "messages": [
                                        {
                                        "attachment":{
                                        "type":"template",
                                        "payload":{
                                        "template_type":"generic",
                                        "elements":[';
                foreach ($result as $row) {
                    $var = $row['counters'];
                }
                $counter = explode(",", $var);
                foreach ($counter as $name_counter){
                    $strjson = $strjson . '{
                                            "title":"'.$name_counter.'",
                                            "image_url":"http://masterpick.summercolors.co/bot/images/'.$name_counter.'.png",
                                            "buttons":[
                                                        {
                                                        "type":"web_url",
                                                        "url":"http://masterpick.summercolors.co/index.html?champ='.$name_counter.'",
                                                        "title":"Master this champion"
                                                        }
                                                        ]
                                            },';
                }
                $strjson = substr ($strjson, 0, strlen($strjson) - 1);                
                $strjson = $strjson . ']}}}]}';
                return $strjson;
            } else {
                return '{"messages": [{"text": "Sorry, I don\'t have info of ' . $champion . ' in ' . $pos . ' :("}]}';
            }
        } else {
            return ' {"messages": [{"text": "Sorry, but \"' . $champion . '\" is not a champ :("}]}';
        }
    }

}

function isChamp($champion) {
    $name = ucwords($champion);
    $acentos = UtilConexion::$pdo->query("SET NAMES 'utf8'");
    $result = UtilConexion::$pdo->query("select * from champions where name='$name'");
    if ($result->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}
