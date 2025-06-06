<?php
require_once __DIR__ .'/../config/configdatabase.php';
class Producto {


   public function guardar($nombre, $codigo, $precio_compra, $precio_venta, $stock, $unidad_medida, $id_categoria, $id_proveedor, $fecha_ingreso, $activo) {
    $conn = Database::getConnection();

    $stmt = $conn->prepare("
        INSERT INTO productos (nombre, codigo, precio_compra, precio_venta, stock, unidad_medida, id_categoria, id_proveedor, fecha_ingreso, activo)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param("ssddissisi", 
        $nombre, $codigo, $precio_compra, $precio_venta, $stock, 
        $unidad_medida, $id_categoria, $id_proveedor, $fecha_ingreso, $activo
    );

    if ($stmt->execute()) {
        echo "<script>alert('Producto registrado exitosamente.'); window.location.href = '/dashboard/productos';</script>";
    } else {
        echo "<script>alert('Error al registrar el producto.'); window.location.href = '/producto/crear';</script>";
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
public function obtenerProductosFiltrados(
    string $search,
    string $stockFilter,
    string $categoriaId
): array {
    $conn = Database::getConnection();

    // Base de la consulta con join para obtener nombre de categoría
    $sql = "
      SELECT p.*, c.nombre AS categoria_nombre
      FROM productos p
      LEFT JOIN categorias c ON p.id_categoria = c.id
    ";

    $conds  = [];
    $params = [];
    $types  = '';

    // Filtro de texto (nombre, código, categoría)
    if ($search !== '') {
        $conds[]    = "(p.nombre LIKE ? OR p.codigo LIKE ? OR c.nombre LIKE ?)";
        $like       = "%{$search}%";
        $params    = array_merge($params, [$like, $like, $like]);
        $types     .= 'sss';
    }

    // Filtro por rango de stock
    switch ($stockFilter) {
        case 'low':
            $conds[] = "p.stock <= 5";
            break;
        case 'mid':
            $conds[] = "p.stock BETWEEN 6 AND 10";
            break;
        case 'high':
            $conds[] = "p.stock > 10";
            break;
    }

    // Filtro por categoría
    if ($categoriaId !== '') {
        $conds[]   = "p.id_categoria = ?";
        $params[]  = $categoriaId;
        $types    .= 'i';
    }

    // Si hay condiciones, agrégalas al WHERE
    if (count($conds) > 0) {
        $sql .= ' WHERE ' . implode(' AND ', $conds);
    }

    // Ordenar siempre por stock ascendente
    $sql .= ' ORDER BY p.stock ASC';

    // Preparar y bind de parámetros dinámicos
    $stmt = $conn->prepare($sql);
    if ($types !== '') {
        // bind_param requiere variables por referencia, así que usamos call_user_func_array
        $refs = [];
        foreach ($params as $k => $v) {
            $refs[$k] = &$params[$k];
        }
        array_unshift($refs, $types);
        call_user_func_array([$stmt, 'bind_param'], $refs);
    }

    $stmt->execute();
    $productos = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return $productos;
}

public function contarFiltrados(string $search, string $stockFilter, string $categoriaId): int {
        $conn = Database::getConnection();
        // Reusa la lógica de construcción de WHERE de tu método obtenerProductosFiltrados
        $sql = "SELECT COUNT(*) AS total
                FROM productos p
                LEFT JOIN categorias c ON p.id_categoria = c.id";
        $conds = []; $params = []; $types = '';
        if ($search!=='') {
            $conds[] = "(p.nombre LIKE ? OR p.codigo LIKE ? OR c.nombre LIKE ?)";
            $like = "%{$search}%";
            $params = array_merge($params, [$like,$like,$like]);
            $types .= 'sss';
        }
        switch($stockFilter) {
            case 'low':  $conds[]="p.stock<=5";   break;
            case 'mid':  $conds[]="p.stock BETWEEN 6 AND 10"; break;
            case 'high': $conds[]="p.stock>10";   break;
        }
        if ($categoriaId!=='') {
            $conds[]="p.id_categoria = ?"; $params[]=$categoriaId; $types.='i';
        }
        if (count($conds)>0) $sql .= ' WHERE '.implode(' AND ',$conds);
        $stmt = $conn->prepare($sql);
        if ($types!=='') {
            // bind dinámico
            $refs=[]; foreach($params as $i=>&$p){$refs[$i]=&$params[$i];}
            array_unshift($refs,$types);
            call_user_func_array([$stmt,'bind_param'],$refs);
        }
        $stmt->execute();
        $total = $stmt->get_result()->fetch_assoc()['total'] ?? 0;
        $stmt->close();
        return (int)$total;
    }

    // (b) Obtiene una página de productos con limit & offset
    public function obtenerPagina(
        string $search, string $stockFilter, string $categoriaId,
        int $limit, int $offset
    ): array {
        $conn = Database::getConnection();
        $sql = "SELECT p.*, c.nombre AS categoria_nombre
                FROM productos p
                LEFT JOIN categorias c ON p.id_categoria = c.id";
        $conds=[]; $params=[]; $types='';
        if ($search!=='') {
            $conds[]="(p.nombre LIKE ? OR p.codigo LIKE ? OR c.nombre LIKE ?)";
            $like="%{$search}%";
            $params=array_merge($params,[$like,$like,$like]);
            $types.='sss';
        }
        switch($stockFilter) {
            case 'low':  $conds[]="p.stock<=5";   break;
            case 'mid':  $conds[]="p.stock BETWEEN 6 AND 10"; break;
            case 'high': $conds[]="p.stock>10";   break;
        }
        if ($categoriaId!=='') {
            $conds[]="p.id_categoria = ?"; $params[]=$categoriaId; $types.='i';
        }
        if (count($conds)>0) $sql .= ' WHERE '.implode(' AND ',$conds);
        $sql .= ' ORDER BY p.stock ASC LIMIT ? OFFSET ?';
        $types .= 'ii';
        $params[] = $limit;
        $params[] = $offset;
        $stmt = $conn->prepare($sql);
        // bind dinámico
        $refs=[]; foreach($params as $i=>&$p){$refs[$i]=&$params[$i];}
        array_unshift($refs,$types);
        call_user_func_array([$stmt,'bind_param'],$refs);
        $stmt->execute();
        $rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $rows;
    }


}
