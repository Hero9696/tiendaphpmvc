<?php

require_once __DIR__ . '/../config/configdatabase.php';

class Proveedor {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    public function obtenerProveedores(): array {
        $sql = "SELECT id, nombre FROM proveedores ORDER BY nombre ASC";
        $result = $this->conn->query($sql);
        $proveedores = [];

        while ($row = $result->fetch_assoc()) {
            $proveedores[] = $row;
        }

        return $proveedores;
    }
}
