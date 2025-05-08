<?php
require __DIR__ . '/../middleware/auth.php'; // Asegúrate de que la ruta sea correcta

$userData = verificarToken();

// Aquí ya puedes usar $userData->rol o $userData->id
echo json_encode([
    "mensaje" => "Acceso autorizado",
    "usuario" => $userData->usuario,
    "rol" => $userData->rol
]);
