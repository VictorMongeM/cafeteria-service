<?php

// Importar middlewares
require_once '../middleware/AuthMiddleware.php';
require_once '../middleware/Cors.php';
require_once '../middleware/LoggingMiddleware.php';

// llamar middlewares
AuthMiddleware::verificarToken();
LoggingMiddleware::registrarSolicitud();
Cors::permitirOrigen();

// Importar rutas
require_once 'routes/empleadoRoutes.php';
?>
