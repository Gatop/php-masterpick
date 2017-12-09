<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of problem
 *
 * @author Gatop
 */
class suscribir {

    function suscribirAlpha($pDatos) {
        extract($pDatos);
        $name = addslashes(trim($_POST['name']));
        $email = addslashes(trim($_POST['email']));
        $champion = addslashes(trim($_POST['champion']));
        $message = addslashes(trim($_POST['message']));
        $emailTo = 'contact@summercolors.co';
        // Send email
        $headers = "From: " . $name . " <" . $email . ">" . "\r\n" . "Reply-To: " . $email;
        if(mail($emailTo, 'Masterpick Alpha', $message.' '.$champion, $headers)){
            echo json_encode(array('ok' => true));
        }else{
            echo json_encode(array('ok' => false, 'mensaje' =>'Error sending email.'));
        }
    }
    
    function mensajePorok($pDatos) {
        extract($pDatos);
        $name = addslashes(trim($_POST['name']));
        $message = addslashes(trim($_POST['message']));
        $emailTo = 'contact@summercolors.co';
        // Send email
        $headers = "From: " . $name;
        if(mail($emailTo, 'Porok Message', $message, $headers)){
            echo json_encode(array('ok' => true));
        }else{
            echo json_encode(array('ok' => false, 'mensaje' =>'Error sending email.'));
        }
    }
    
}

