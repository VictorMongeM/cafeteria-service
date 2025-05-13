<?php
// Importar middlewares
require_once __DIR__ . '/../../middleware/AuthMiddleware.php';
require_once __DIR__ . '/../../middleware/Cors.php';
require_once __DIR__ . '/../../middleware/LoggingMiddleware.php';

// llamar middlewares
LoggingMiddleware::registrarSolicitud();
Cors::permitirOrigen();
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // Establece el código de estado 200 OK para el preflight.
    // Las cabeceras Access-Control ya fueron añadidas por Cors::permitirOrigen().
    http_response_code(200);
    exit; // Detiene la ejecución del script, enviando solo las cabeceras CORS y el estado 200.
}
AuthMiddleware::verificarToken();

// Importar rutas
require_once __DIR__ . '/routes/ventasRoutes.php';
?>
