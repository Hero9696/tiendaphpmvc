<?php
require_once __DIR__ .'/../config/configdatabase.php';
class Producto {


    public function guardar($nombre, $codigo, $precio_compra, $precio_venta, $stock, $id_categoria) {
         $conn = Database::getConnection();
    
        $stmt = $conn->prepare("INSERT INTO productos (nombre,codigo, precio_compra, precio_venta,stock, id_categoria) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $nombre, $codigo, $precio_compra, $precio_venta, $stock, $id_categoria);    
    
        if ($stmt->execute()) {
            echo "<script>alert('Usuario registrado exitosamente.'); window.location.href = '/';</script>";
        } else {
            echo "<script>alert('Error al registrar el usuario. Puede que ya exista.'); window.location.href = '/registrer';</script>";
        }
    }

    public function obtenerProductosOrdenadosPorStock() {
        $conn = Database::getConnection();

        $stmt = $conn->prepare("SELECT * FROM productos ORDER BY stock ASC");
        $stmt->execute();
        $resultado = $stmt->get_result();
        $productos = $resultado->fetch_all(MYSQLI_ASSOC);

        $stmt->close();
        return $productos;
    }
}
