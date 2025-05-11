<?php
$host = "localhost";
$database = "cafeteria";
$password = "123";
$user = "cafeteria";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

?>
