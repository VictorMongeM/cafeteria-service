<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
 
//$data = ['user_id' => 123, 'role' => 'admin'];
$token = AuthMiddleware::generarToken();
 
class AuthMiddleware {
    // CONSIDERACIÓN: Guardar la clave secreta directamente en el código
    // no es la práctica más segura. Mejor usar variables de entorno.
    private static $secretKey = "TJ0k0Maod8aWRyE2cxogvcXHm0rD4tnArm/2GlPYoIz4jThfMMLvML8bgCgz7FBShNZfJ12EVrQVfBJOsyGksyKI4fX8CW2GzB5b+LBv6x6RbCjlD40qzP/nW5xJG3kKx5LULX+GiDQB6m9qsL3bsTzy8Z4D3SI7puEB8K+JiDg=";
 
 
    // Método para generar un token con header, payload y signature
    public static function generarToken() {
        $playload = [
            'iat' => time(),
        ];
 
        $token = JWT::encode($playload, self::$secretKey, 'HS256');
        return $token;
    }
 
    public static function verificarToken() {

        // Si el método de la solicitud es OPTIONS (preflight), permite que pase.
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            // No necesitamos autenticar una solicitud OPTIONS.
            // Permitimos que continúe para que se envíen las cabeceras CORS.
            return;
        }
        // ************************


        // NOTA: apache_request_headers() solo funciona en Apache.
        // Para mayor compatibilidad, considerar getallheaders() o
        // buscar en $_SERVER['HTTP_AUTHORIZATION'] (puede variar).
        $headers = apache_request_headers();

        if (!isset($headers['Authorization'])) {
            // Esta respuesta 401/403 SÓLO debe ocurrir para solicitudes
            // que NO son OPTIONS y no tienen el token.
            header("HTTP/1.1 401 Unauthorized");
            echo json_encode(["error" => "Token no proporcionado"]);
            exit; // Sale del script si la autenticación falla en una solicitud no-OPTIONS.
        }

        $authHeader = $headers['Authorization'];
        $token = str_replace('Bearer ', '', $authHeader);

        try {
            $decoded = JWT::decode($token, new Key(self::$secretKey, 'HS256'));

            // Opcional: Se puede guardar $decoded o usarlo para pasar datos del usuario autenticado
            // a las funciones del controlador.

        } catch (\Firebase\JWT\ExpiredException $e) {
            header("HTTP/1.1 401 Unauthorized");
            echo json_encode(["error" => "Token expirado"]);
            exit;
        } catch (\Exception $e) {
            header("HTTP/1.1 403 Forbidden");
            echo json_encode(["error" => "Token inválido: " . $e->getMessage()]);
            exit;
        }
    }
}
 
// echo json_encode([
//     'token' => AuthMiddleware::generarToken()
// ]);
?>