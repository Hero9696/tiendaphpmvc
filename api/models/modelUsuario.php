<?php
require_once __DIR__ . '/../config/configdatabase.php';

class Usuario {

    private $conn;

    public function __construct($conn = null) {
        $this->conn = $conn ?? Database::getConnection();
    }

    public function registrar($nombre, $usuario, $clave, $rol) {
        if (!$this->validarClave($clave)) {
            throw new Exception('Contraseña insegura');
        }

        $claveHash = password_hash($clave, PASSWORD_BCRYPT);
        $stmt = $this->conn->prepare("INSERT INTO usuarios (nombre, usuario, clave, rol) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nombre, $usuario, $claveHash, $rol);

        if (!$stmt->execute()) {
            throw new Exception('No se pudo registrar el usuario. Posiblemente ya existe.');
        }
    }

    public function buscarPorUsuario($usuario) {
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }

    public function verificar($usuario, $clave) {
        $stmt = $this->conn->prepare("SELECT clave FROM usuarios WHERE usuario = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $datos = $resultado->fetch_assoc();

        return $datos && password_verify($clave, $datos['clave']);
    }

    private function validarClave($clave) {
        return strlen($clave) >= 8 &&
               preg_match('/[a-z]/', $clave) &&
               preg_match('/[A-Z]/', $clave) &&
               preg_match('/[0-9]/', $clave) &&
               preg_match('/[\W]/', $clave);
    }
}
