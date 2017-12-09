<?php

header('Content-Type: text/html; charset=UTF-8');
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");  // disable IE caching
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");

error_reporting(E_ALL);
$errores = '';
try {
    //UtilConexion::getInstance(/***************** ver UtilConexion *********************** */);
    if (isset($_REQUEST['clase'])) {
        $clase = $_REQUEST['clase'];
        
        if (isset($_REQUEST['oper'])) {
            $metodo = $_REQUEST["oper"];
            $argumentos = $_REQUEST;
            $argumentos['error'] = $errores;
            if (substr($clase, 0, 4) === 'Util') {  // Llamado a métodos de clase
                $clase::$metodo($argumentos);
            } else {                                // Llamado a metodos de instancia
                $obj = new $clase();
                $obj->$metodo($argumentos);
            }
        } else {
            throw new Exception('El controlador no ha recibido un mensaje válido.');
        }
    } else {
        throw new Exception('El controlador no sabe a quien enviar el mensaje.');
    }
} catch (Exception $e) {
    echo json_encode(array("ok" => 2, "mensaje" => $e->getMessage()));
}

/**
 * Intenta cargar aquellas clases que no se incluyen explícitamente.
 * @param <type> $nombreClase el nombre de la clase que se intentará cargar
 * desde la ruta ../modelo/
 * IMPORTANTE: include_once no lanza excepciones
 */
function __autoload($nombreClase) {
    if (substr($nombreClase, 0, 4) == 'Util') {
        $nombreClase = "../ServiciosTecnicos/Utilidades/$nombreClase.php";
    } else if (substr($nombreClase, 0, 4) == 'Info') {
        $nombreClase = "../ServiciosTecnicos/Informes/$nombreClase.php";
    } else if (substr($nombreClase, 0, 8) == 'PHPExcel') {
        // OJO CON ESTA ELEGANCIA  <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
        $nombreClase = "../../includes/PHPExcel_1.7.4/" . str_replace('_', '/', $nombreClase) . '.php';
    } else {
        $nombreClase = "../Modelo/$nombreClase.php";
    }

    if (file_exists($nombreClase)) {
        include_once($nombreClase);
    } else {
        throw new Exception("No existe la clase $nombreClase");
    }
}

?>
