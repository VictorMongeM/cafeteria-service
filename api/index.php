<?php
// api/index.php
$request_uri = $_SERVER['REQUEST_URI'];
$request_method = $_SERVER['REQUEST_METHOD'];

if (strpos($request_uri, '/api/empleados') === 0) {
    # Aquí se incluyen todos los index.php de los endpoints
    include '../src/empleados/index.php';
} else if (strpos($request_uri, '/api/ventas') === 0) {
    include '../src/ventas/index.php';
} else {
    http_response_code(404);
    header('Content-Type: application/xml');
    echo "<error>Ruta no encontrada</error>";
}
?>