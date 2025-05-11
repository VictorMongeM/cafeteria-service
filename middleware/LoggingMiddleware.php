<?php
 
/**
 * Middleware para registrar las solicitudes en un archivo de log.
 * Este middleware registra la fecha y hora de la solicitud, la URL solicitada y la dirección IP del cliente.
 */

// $_SERVER['REQUEST_URI'] contiene la URL solicitada
// $_SERVER['REMOTE_ADDR'] contiene la dirección IP del cliente
// $_SERVER['REQUEST_METHOD'] contiene el método HTTP utilizado (GET, POST, etc.)
// $_SERVER['HTTP_USER_AGENT'] contiene información sobre el navegador del cliente
// PHP_EOL es una constante que representa un salto de línea en PHP

// date("Y-m-d H:i:s") obtiene la fecha y hora actual en el formato deseado
// file_put_contents() escribe el mensaje en el archivo de log, y FILE_APPEND indica que se debe agregar al final del archivo
class LoggingMiddleware {
    public static function registrarSolicitud() {
        $archivo_log = "../logs/accesos.log";
        $mensaje = date("Y-m-d H:i:s") . " - " . $_SERVER['REQUEST_URI'] . " - " . $_SERVER['REMOTE_ADDR'] . PHP_EOL;
        file_put_contents($archivo_log, $mensaje, FILE_APPEND);
    }
}
?>