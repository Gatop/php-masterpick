/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function suscribir() {
    $.post('Controlador/Fachada.php', {
        clase: 'suscribir',
        oper: 'suscribirAlpha',
        name: $('#name').val(),
        email: $('#email').val(),
        champion: $('#champion').val(),
        message: $('#message').val()
    }, function (data) {
        if (data.ok) {
            $("#form").toggle("slow", function () {
                // Animation complete.
            });
            $("#preform").toggle("slow", function () {
                // Animation complete.
            });
            $("#answer").toggle("slow", function () {
                // Animation complete.
            });
        } else {
            $.alert({
                title: 'Error',
                content: data.mensaje,
                autoClose: 'confirm|10000',
                confirmButton: 'Close',
                confirmButtonClass: 'btn-danger'
            });
        }
    }, 'json');
}


function mensaje() {
    $.post('Controlador/Fachada.php', {
        clase: 'suscribir',
        oper: 'mensajePorok',
        name: $('#name').val(),
        message: $('#message').val()
    }, function (data) {
        if (data.ok) {
            $("#form2").toggle("slow", function () {
                // Animation complete.
            });
            $("#preform2").toggle("slow", function () {
                // Animation complete.
            });
            $("#answer2").toggle("slow", function () {
                // Animation complete.
            });
        } else {
            $.alert({
                title: 'Error',
                content: data.mensaje,
                autoClose: 'confirm|10000',
                confirmButton: 'Close',
                confirmButtonClass: 'btn-danger'
            });
        }
    }, 'json');
}



