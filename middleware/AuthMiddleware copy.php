<?php
 
class AuthMiddleware {

    public static function verificarToken() {

        $headers = apache_request_headers(); // Obtener los encabezados de la solicitud

        // Verificar si el encabezado Authorization está presente
        if (!isset($headers['Authorization'])) {
            header("HTTP/1.1 401 Unauthorized");
            echo json_encode(["error" => "Token no proporcionado"]);
            exit;
        }
        
        // Obtener el token del encabezado Authorization
        $token = $headers['Authorization'];

        if ($token !== "Bearer soaservices") {
            header("HTTP/1.1 403 Forbidden");
            echo json_encode(["error" => "Token inválido"]);
            exit;
        }
    }
}
?>