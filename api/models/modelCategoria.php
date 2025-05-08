<?php
 require_once __DIR__ .'/../config/configdatabase.php';

class Categoria {
   

    public function obtenerCategorias() {
        global $conn;

        $stmt = $conn->prepare("SELECT id, nombre FROM categorias");
        $stmt->execute();
        $resultado = $stmt->get_result();
        $categoriaEncontrada = $resultado->fetch_assoc();

        $stmt->close();
        return $categoriaEncontrada;
    }
}
