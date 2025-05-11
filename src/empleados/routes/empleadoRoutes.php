<?php
require_once __DIR__ . '/../controllers/EmpleadoController.php';

// Obtener la URI
$request_uri = $_SERVER['REQUEST_URI'];
// Obtener el método de la solicitud
$request_method = $_SERVER["REQUEST_METHOD"];

/**
 * Rutas para la API de empleados
 * /api/empleados/obtenerTodos
 * /api/empleados/obtenerPorId/{id}             @param id int
 * /api/empleados/ordenarPorPuestos/{puesto}    @param puesto string [Mesero, Cajero, Cocinero] o int [1, 2, 3]
 * /api/empleados/crearEmpleado
 * /api/empleados/actualizarEmpleado
 * /api/empleados/eliminarEmpleado
 *
 */

# Obtener todos los empleados
if ($request_method === "GET" && $request_uri === '/api/empleados/obtenerTodos') {
    EmpleadoController::index();

# Obtener empleado por id
} elseif ($request_method === "GET" && preg_match('/\/api\/empleados\/obtenerPorId\/(\d+)/', $request_uri, $matches)) {
    $id = $matches[1];
    EmpleadoController::show($id);

# Ordenar empleados por puesto, por id
} elseif ($request_method === "GET" && preg_match('/\/api\/empleados\/ordenarPorPuestos\/(\d+)/', $request_uri, $matches)) {
    $puesto = $matches[1];
    EmpleadoController::ordenarPorPuestos($puesto);

# Ordenar empleados por puesto, por nombre
} elseif ($request_method === "GET" && preg_match('/\/api\/empleados\/ordenarPorPuestos\/([a-zA-Z]+)/', $request_uri, $matches)) {
    $puesto = $matches[1];
    EmpleadoController::ordenarPorPuestos($puesto);

# Crear empleado
} else if ($request_method === "POST" && $request_uri === '/api/empleados/crearEmpleado') {
    EmpleadoController::create();

# Actualizar empleado
} else if($request_method === "PUT" && $request_uri == '/api/empleados/actualizarEmpleado'){
    EmpleadoController::update();

# Eliminar empleado
} else if($request_method === "DELETE" && $request_uri == '/api/empleados/eliminarEmpleado'){
    EmpleadoController::delete();

# Si la ruta no coincide, devolver error 404
}else {
    header("HTTP/1.1 404 Not Found");
}
?>