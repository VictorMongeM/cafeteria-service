<?php
require_once __DIR__ . '/../controllers/VentasController.php';

# Obtener la URI y el metodo de la solicitud
$request_uri = $_SERVER['REQUEST_URI'];
$request_method = $_SERVER['REQUEST_METHOD'];

/** RUTAS ==============================================================================================================
 * Ruta para obtener el total de ventas
 * GET api/ventas/total
 * Ruta para obtener el empleado con más ventas
 * GET api/ventas/empleado
 * Ruta para obtener el producto más vendido
 * GET api/ventas/producto
 * Ruta para obtener la sucursal con más ventas
 * GET api/ventas/sucursal
 * Ruta para obtener la lista de ventas
 * GET api/ventas/lista
======================================================================================================================*/

if ($request_method === "GET" && $request_uri === '/api/ventas/total') {
    VentasController::obtenerTotalVentas();
} elseif ($request_method === "GET" && $request_uri === '/api/ventas/empleado') {
    VentasController::obtenerEmpleadoMasVentas();
} elseif ($request_method === "GET" && $request_uri === '/api/ventas/producto') {
    VentasController::obtenerProductoMasVendido();
} elseif ($request_method === "GET" && $request_uri === '/api/ventas/sucursal') {
    VentasController::obtenerSucursalMasVentas();
} elseif ($request_method === "GET" && $request_uri === '/api/ventas/lista') {
    VentasController::obtenerListaVentas();
} else {
    http_response_code(404);
    header('Content-Type: application/xml');
    echo "<error>Ruta no encontrada</error>";
}

?>