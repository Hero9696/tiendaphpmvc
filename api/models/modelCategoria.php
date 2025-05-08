<?php
 require_once __DIR__ .'/../config/configdatabase.php';

class Categoria {
   

    public function obtenerCategorias() {
         $conn = Database::getConnection();

        $stmt = $conn->prepare("SELECT id, nombre FROM categorias");
        $stmt->execute();
        $resultado = $stmt->get_result();
        $categoriaEncontrada = $resultado->fetch_all(MYSQLI_ASSOC); 

        $stmt->close();
        return $categoriaEncontrada;
    }
}
