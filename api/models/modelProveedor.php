<?php

require_once __DIR__ . '/../config/configdatabase.php';

class Proveedor {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    public function obtenerProveedores(): array {
        $sql = "SELECT id, nombre, contacto, telefono, email FROM proveedores ORDER BY nombre ASC";
        $result = $this->conn->query($sql);
        $proveedores = [];

        while ($row = $result->fetch_assoc()) {
            $proveedores[] = $row;
        }

        return $proveedores;
    }

      public function obtenerPorId(int $id): ?array {
        $stmt = $this->conn->prepare(
            "SELECT id, nombre, contacto, telefono, email FROM proveedores WHERE id = ? LIMIT 1"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $row ?: null;
    }


    public function guardar(string $nombre, string $contacto, string $telefono, string $email): bool {
        $stmt = $this->conn->prepare(
            "INSERT INTO proveedores (nombre, contacto, telefono, email) VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("ssss", $nombre, $contacto, $telefono, $email);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

 
    public function actualizar(int $id, string $nombre, string $contacto, string $telefono, string $email): bool {
        $stmt = $this->conn->prepare(
            "UPDATE proveedores SET nombre = ?, contacto = ?, telefono = ?, email = ? WHERE id = ?"
        );
        $stmt->bind_param("ssssi", $nombre, $contacto, $telefono, $email, $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    
    public function eliminar(int $id): bool {
        $stmt = $this->conn->prepare("DELETE FROM proveedores WHERE id = ?");
        $stmt->bind_param("i", $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }
}
