<?php
 require_once __DIR__ .'/../config/configdatabase.php';

class Categoria {
   

   public function obtenerCategorias(): array {
    $conn = Database::getConnection();

    // Selecciona categorías ordenadas alfabéticamente por nombre
    $stmt = $conn->prepare("
        SELECT id, nombre
        FROM categorias
        ORDER BY nombre ASC
    ");
    $stmt->execute();

    $resultado = $stmt->get_result();
    $categoriaEncontrada = $resultado->fetch_all(MYSQLI_ASSOC);

    $stmt->close();
    return $categoriaEncontrada;
}

}
