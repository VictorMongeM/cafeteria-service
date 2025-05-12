<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
 
$data = ['user_id' => 123, 'role' => 'admin'];
$token = AuthMiddleware::generarToken($data);
 
class AuthMiddleware {
    private static $secretKey = "TJ0k0Maod8aWRyE2cxogvcXHm0rD4tnArm/2GlPYoIz4jThfMMLvML8bgCgz7FBShNZfJ12EVrQVfBJOsyGksyKI4fX8CW2GzB5b+LBv6x6RbCjlD40qzP/nW5xJG3kKx5LULX+GiDQB6m9qsL3bsTzy8Z4D3SI7puEB8K+JiDg=";
 
 
    // Método para generar un token con header, payload y signature
    public static function generarToken($data) {
        $playload = [
            'iat' => time(),
            'exp' => time() + 3600,
            'data' => $data
        ];
 
        $token = JWT::encode($playload, self::$secretKey, 'HS256');
        return $token;
    }
 
    // Método para verificar un token
    public static function verificarToken() {
        $headers = apache_request_headers();
        if (!isset($headers['Authorization'])) {
            header("HTTP/1.1 401 Unauthorized");
            echo json_encode(["error" => "Token no proporcionado"]);
            exit;
        }
 
        $authHeader = $headers['Authorization'];
        $token = str_replace('Bearer ', '', $authHeader);
 
        try {
            $decoded = JWT::decode($token, new Key(self::$secretKey, 'HS256'));
 
        } catch (\Firebase\JWT\ExpiredException $e) {
            header("HTTP/1.1 401 Unauthorized");
            echo json_encode(["error" => "Token expirado"]);
            exit;
        } catch (\Exception $e) {
            header("HTTP/1.1 403 Forbidden");
            echo json_encode(["error" => "Token inválido"]);
            exit;
        }
    }
}
 
//echo json_encode([
//    'token' => $token
//]);
?>