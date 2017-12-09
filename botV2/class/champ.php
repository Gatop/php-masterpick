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

    function getCounters($champion, $lan) {
        if (isChamp($champion)) {
            $name = getChampName($champion);
            $acentos = UtilConexion::$pdo->query("SET NAMES 'utf8'");
            $result = UtilConexion::$pdo->query("select counters,pos from counterpick where champion='$name'");
            if ($result->rowCount() > 0) {
                $strjson = '{ "messages": [';
                foreach ($result as $row) {
                    $pos = $row['pos'];
                    $strjson = $strjson . '{"text": "Counterpicks ' . $name . ' - ' . $pos . '"},';
                    $strjson = $strjson . '{
                                        "attachment":{
                                        "type":"template",
                                        "payload":{
                                        "template_type":"generic",
                                        "elements":[';
                    $var = $row['counters'];
                    $counter = explode(",", $var);
                    foreach ($counter as $name_counter) {
                        $strjson = $strjson . '{
                                            "title":"' . $name_counter . '",
                                            "image_url":"http://masterpick.summercolors.co/bot/images/' . $name_counter . '.png",
                                            "buttons":[
                                                        {
                                                        "type":"web_url",
                                                        "url":"http://masterpick.summercolors.co/index.html?champ=' . $name_counter . '",
                                                        "title":"Master this champion"
                                                        }
                                                        ]
                                            },';
                    }
                    $strjson = substr($strjson, 0, strlen($strjson) - 1);
                    $strjson = $strjson . ']}}},';
                }
                $strjson = substr($strjson, 0, strlen($strjson) - 1);
                if ($lan == 'en') {
                   $strjson =  $strjson . ',{
                            "attachment": {
                              "type": "template",
                              "payload": {
                                "template_type": "button",
                                "text": "More Counterpicks?",
                                "buttons": [
                                  {
                                    "type": "show_block",
                                    "block_name": "EN_Counter",
                                    "title": "Counterpick"
                                  },
                                  {
                                    "type": "show_block",
                                    "block_name": "EN_Porok",
                                    "title": "Make me smile :D"
                                  }
                                ]
                              }
                            }
                          }';
                }else{
                     $strjson =  $strjson .',{
                            "attachment": {
                              "type": "template",
                              "payload": {
                                "template_type": "button",
                                "text": "Otro Counterpick?",
                                "buttons": [
                                  {
                                    "type": "show_block",
                                    "block_name": "ES_Counter",
                                    "title": "Counterpick"
                                  },
                                  {
                                    "type": "show_block",
                                    "block_name": "ES_Porok",
                                    "title": "Sonreir :D"
                                  }
                                ]
                              }
                            }
                          }';
                }
                $strjson = $strjson . ']}';
                return $strjson;
            } else {
                return '{"messages": [{"text": "Sorry, I don\'t have info of ' . $name . ' in ' . $pos . ' :("}]}';
            }
        } else {
            if ($lan == 'en') {
                return'[
                          {
                            "attachment": {
                              "type": "template",
                              "payload": {
                                "template_type": "button",
                                "text": "Sorry, but \"' . $champion . '\" is not a champ :(",
                                "buttons": [
                                  {
                                    "type": "show_block",
                                    "block_name": "EN_Counter",
                                    "title": "Counterpick"
                                  },
                                  {
                                    "type": "show_block",
                                    "block_name": "EN_Porok",
                                    "title": "Make me smile :D"
                                  }
                                ]
                              }
                            }
                          }
                        ]';
            } else {
                return'[
                          {
                            "attachment": {
                              "type": "template",
                              "payload": {
                                "template_type": "button",
                                "text": "Lo siento, pero \"' . $champion . '\" no es un campeón :(",
                                "buttons": [
                                  {
                                    "type": "show_block",
                                    "block_name": "ES_Counter",
                                    "title": "Counterpick"
                                  },
                                  {
                                    "type": "show_block",
                                    "block_name": "ES_Porok",
                                    "title": "Sonreir :D"
                                  }
                                ]
                              }
                            }
                          }
                        ]';
            }
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
        $name2 = substr($name, 0, 3);
        $result2 = UtilConexion::$pdo->query("select * from champions where name LIKE '$name2%'");
        if ($result2->rowCount() == 1) {
            return true;
        } else if ($result2->rowCount() > 1) {
            $name3 = substr($name, 0, 4);
            $result3 = UtilConexion::$pdo->query("select * from champions where name LIKE '$name3%'");
            if ($result3->rowCount() == 1) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

function getChampName($champion) {
    $name = ucwords($champion);
    $acentos = UtilConexion::$pdo->query("SET NAMES 'utf8'");
    $result = UtilConexion::$pdo->query("select name from champions where name='$name'");
    if ($result->rowCount() > 0) {
        foreach ($result as $row) {
            $names = $row['name'];
        }
        return $names;
    } else {
        $name2 = substr($name, 0, 3);
        $result2 = UtilConexion::$pdo->query("select name from champions where name LIKE '$name2%'");
        if ($result2->rowCount() == 1) {
            foreach ($result2 as $row) {
                $names = $row['name'];
            }
        } else if ($result2->rowCount() > 1) {
            $name3 = substr($name, 0, 4);
            $result3 = UtilConexion::$pdo->query("select name from champions where name LIKE '$name3%'");
            if ($result3->rowCount() == 1) {
                foreach ($result3 as $row) {
                    $names = $row['name'];
                }
            }
        }
        return $names;
    }
}
