<?php
// api/index.php
$request_uri = $_SERVER['REQUEST_URI'];
$request_method = $_SERVER['REQUEST_METHOD'];

if (strpos($request_uri, '/api/empleados') === 0) {
    # Aquí se incluyen todos los index.php de los endpoints
    include '../src/empleados/index.php';

} else {
    header("HTTP/1.1 404 Not Found");
}
?>