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

    public function actualizar(
    string $nombre,
    string $codigo,
    float $precio_compra,
    float $precio_venta,
    int $stock,
    int $id_categoria
): bool {
    $conn = Database::getConnection();

    $sql = "
        UPDATE productos
        SET 
            nombre         = ?,
            codigo         = ?,
            precio_compra  = ?,
            precio_venta   = ?,
            stock          = ?,
            id_categoria   = ?
        WHERE codigo = ?
    ";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        // Error al preparar la consulta
        return false;
    }

    // Tipos: s = string, d = double, i = integer
    $stmt->bind_param(
        "ssddiis",
        $nombre,
        $codigo,
        $precio_compra,
        $precio_venta,
        $stock,
        $id_categoria,
        $codigo // Código para la cláusula WHERE
    );

    $ok = $stmt->execute();
    $stmt->close();
    return $ok;
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


   public function obtenerPorCodigo(string $codigo): ?array {
    // Obtén la conexión
    $conn = Database::getConnection();

    // Prepara la consulta filtrando por código
    $stmt = $conn->prepare("SELECT * FROM productos WHERE codigo = ? LIMIT 1");
    $stmt->bind_param("s", $codigo);
    $stmt->execute();

    // Recupera un solo registro
    $resultado = $stmt->get_result();
    $producto = $resultado->fetch_assoc() ?: null;

    $stmt->close();
    return $producto;
}
}
