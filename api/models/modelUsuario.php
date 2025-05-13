<?php
// models/modelUsuario.php
require_once __DIR__ . '/../config/configdatabase.php';

class Usuario {
    private $conn;

    public function __construct($conn = null) {
        $this->conn = $conn ?? Database::getConnection();
    }

   
    public function registrar(
        string $nombre,
        string $usuario,
        string $email,
        string $clave,
        int $id_rol
    ): void {
        if (!$this->validarClave($clave)) {
            throw new Exception('La contraseña debe tener al menos 8 caracteres, incluir mayúscula, minúscula, número y símbolo.');
        }

        $claveHash = password_hash($clave, PASSWORD_DEFAULT);
      $stmt = $this->conn->prepare(
    "INSERT INTO usuarios (nombre, usuario, email, clave, id_rol) VALUES (?, ?, ?, ?, ?)"
);
$stmt->bind_param("ssssi", $nombre, $usuario, $email, $claveHash, $id_rol);


        if (!$stmt->execute()) {
            throw new Exception('No se pudo registrar el usuario. Verifica que el usuario o email no existan.');
        }
        $stmt->close();
    }

    /**
     * Busca un usuario por su nombre de usuario.
     * @param string $usuario
     * @return array|null
     */
    public function buscarPorUsuario(string $usuario): ?array {
        $stmt = $this->conn->prepare(
            "SELECT id, nombre, usuario, email, estado, id_rol, created_at, updated_at
             FROM usuarios WHERE usuario = ?"
        );
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $resultado ?: null;
    }

    /**
     * Verifica credenciales y estado activo. Devuelve datos de usuario o false.
     * @param string $usuario
     * @param string $clave
     * @return array|false
     */
   public function verificar(string $usuario, string $clave) {
    $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $datos = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if ($datos && (bool)$datos['estado'] && password_verify($clave, $datos['clave'])) {
        unset($datos['clave']);
        return $datos;
    }
    return false;
}


    /**
     * Valida fortaleza de la clave.
     */
    private function validarClave(string $clave): bool {
        return strlen($clave) >= 8
            && preg_match('/[a-z]/', $clave)
            && preg_match('/[A-Z]/', $clave)
            && preg_match('/[0-9]/', $clave)
            && preg_match('/[\W]/', $clave);
    }
}