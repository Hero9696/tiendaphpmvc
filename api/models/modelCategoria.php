<?php
 require_once __DIR__ .'/../config/configdatabase.php';

class Categoria {
   

   public function obtenerCategorias(): array {
    $conn = Database::getConnection();

    // Selecciona categorías ordenadas alfabéticamente por nombre
    $stmt = $conn->prepare("
        SELECT id, nombre, descripcion, fecha_creacion
        FROM categorias
        ORDER BY nombre ASC
    ");
    $stmt->execute();

    $resultado = $stmt->get_result();
    $categoriaEncontrada = $resultado->fetch_all(MYSQLI_ASSOC);

    $stmt->close();
    return $categoriaEncontrada;
}

    private $conn;

    public function __construct($conn = null) {
        $this->conn = $conn ?? Database::getConnection();
    }

   

   
    public function obtenerPorId(int $id): ?array {
        $stmt = $this->conn->prepare(
            "SELECT id, nombre, descripcion, fecha_creacion
             FROM categorias WHERE id = ? LIMIT 1"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $cat = $stmt->get_result()->fetch_assoc() ?: null;
        $stmt->close();
        return $cat;
    }

    /**
     * Inserta una nueva categoría
     */
    public function guardar(string $nombre, string $descripcion): bool {
        $stmt = $this->conn->prepare(
            "INSERT INTO categorias (nombre, descripcion) VALUES (?, ?)"
        );
        $stmt->bind_param("ss", $nombre, $descripcion);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    /**
     * Actualiza una categoría existente
     */
    public function actualizar(int $id, string $nombre, string $descripcion): bool {
        $stmt = $this->conn->prepare(
            "UPDATE categorias SET nombre = ?, descripcion = ? WHERE id = ?"
        );
        $stmt->bind_param("ssi", $nombre, $descripcion, $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    /**
     * Elimina una categoría por su ID
     */
    public function eliminar(int $id): bool {
        $stmt = $this->conn->prepare("DELETE FROM categorias WHERE id = ?");
        $stmt->bind_param("i", $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

}
