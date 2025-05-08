<?php
require_once __DIR__ . '/../config/configdatabase.php';

class Venta {
    public function obtenerTotalVentas() {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT SUM(total) AS total_ventas FROM ventas");
        $stmt->execute();
        $resultado = $stmt->get_result()->fetch_assoc();
        return $resultado['total_ventas'] ?? 0;
    }
}


