<?php
require_once __DIR__ . '/../config/configdatabase.php';

class Gasto {
    public function obtenerTotalGastos() {
        global $conn;
        $stmt = $conn->prepare("SELECT SUM(monto) AS total_gastos FROM gastos");
        $stmt->execute();
        $resultado = $stmt->get_result()->fetch_assoc();
        return $resultado['total_gastos'] ?? 0;
    }
}
