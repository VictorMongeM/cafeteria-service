<?php
// Importar middlewares
require_once __DIR__ . '/../../middleware/AuthMiddleware.php';
require_once __DIR__ . '/../../middleware/Cors.php';
require_once __DIR__ . '/../../middleware/LoggingMiddleware.php';

// llamar middlewares
AuthMiddleware::verificarToken();
LoggingMiddleware::registrarSolicitud();
Cors::permitirOrigen();

// Importar rutas
require_once __DIR__ . '/routes/ventasRoutes.php';
?>
