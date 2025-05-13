<?php
require_once __DIR__ . '/../config/configdatabase.php';

class Rol {
    private $conn;
    public function __construct($conn = null) {
        $this->conn = $conn ?? Database::getConnection();
    }

    /** Devuelve todos los roles ordenados alfabéticamente */
    public function obtenerRoles(): array {
        $stmt = $this->conn->prepare("SELECT id, nombre FROM roles ORDER BY nombre ASC");
        $stmt->execute();
        $roles = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $roles;
    }
}