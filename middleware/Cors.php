<?php
 
class Cors {
    public static function permitirOrigen() {
        header("Access-Control-Allow-Origin: *"); // Permitir cualquier origen
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE"); // Métodos permitidos
        header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Encabezados permitidos
    }
}
?>