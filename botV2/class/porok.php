<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of porok
 *
 * @author Gatop
 */
class porok {

    function speak($lan) {
        if ($lan == 'en') {
            $acentos = UtilConexion::$pdo->query("SET NAMES 'utf8'");
            $result = UtilConexion::$pdo->query("select count(*) numero from porok");
            if ($result->rowCount() > 0) {
                foreach ($result as $row) {
                    $var = $row['numero'];
                }
            }
            $random = rand(1, $var);
            $quer = "select phrase from porok where id = '$random' ";
            $result2 = UtilConexion::$pdo->query($quer);
            if ($result2->rowCount() > 0) {
                foreach ($result2 as $row2) {
                    $var2 = $row2['phrase'];
                }
            }
            return'[
                          {
                            "attachment": {
                              "type": "template",
                              "payload": {
                                "template_type": "button",
                                "text": "' . $var2 .'",
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
            $acentos = UtilConexion::$pdo->query("SET NAMES 'utf8'");
            $result = UtilConexion::$pdo->query("select count(*) numero from porokes");
            if ($result->rowCount() > 0) {
                foreach ($result as $row) {
                    $var = $row['numero'];
                }
            }
            $random = rand(1, $var);
            $quer = "select phrase from porokes where id = '$random' ";
            $result2 = UtilConexion::$pdo->query($quer);
            if ($result2->rowCount() > 0) {
                foreach ($result2 as $row2) {
                    $var2 = $row2['phrase'];
                }
            }
            return'[
                          {
                            "attachment": {
                              "type": "template",
                              "payload": {
                                "template_type": "button",
                                "text": "' . $var2 .'",
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

    //put your code here
}
