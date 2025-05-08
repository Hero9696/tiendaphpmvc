<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class CategoriaController {


    public function crear() {
        require_once __DIR__ . '/../models/modelCategoria.php';
        $categoriaModel = new Categoria();
        $categorias = $categoriaModel->obtenerCategorias();
    
        require_once __DIR__ . '/../../views/producto/producto.php';
    }
    
        }
        
    
    

    
