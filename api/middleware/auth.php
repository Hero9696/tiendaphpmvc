<?php
require __DIR__ . '/../../vendor/autoload.php';
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

function verificarToken() {
    $headers = getallheaders();
    if (!isset($headers['Authorization'])) {
        http_response_code(401);
        echo json_encode(["mensaje" => "Token no proporcionado"]);
        exit;
    }

    $token = str_replace("Bearer ", "", $headers['Authorization']);
    $key = 'CLAVE_SECRETA_123';

    try {
        $decoded = JWT::decode($token, new Key($key, 'HS256'));
        return $decoded->data; // datos del usuario
    } catch (Exception $e) {
        http_response_code(401);
        echo json_encode(["mensaje" => "Token inválido o expirado"]);
        exit;
    }
}
