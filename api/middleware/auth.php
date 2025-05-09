<?php
require __DIR__ . '/../../vendor/autoload.php';
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

function verificarToken() {
    // Buscar el token en la cookie
    if (!isset($_COOKIE['token'])) {
        http_response_code(401);
        echo json_encode(["mensaje" => "Token no proporcionado"]);
        exit;
    }

    $token = $_COOKIE['token'];
    $key = 'clave_secreta_segura'; // Debe coincidir con la clave usada al generar el JWT

    try {
        $decoded = JWT::decode($token, new Key($key, 'HS256'));
        return $decoded->usuario; // el campo que pusiste en el payload
    } catch (Exception $e) {
        http_response_code(401);
        echo json_encode(["mensaje" => "Token inválido o expirado"]);
        exit;
    }
}

