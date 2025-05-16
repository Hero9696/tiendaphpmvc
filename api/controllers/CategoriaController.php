<?php

require_once __DIR__ .'/../models/modelCategoria.php';

class CategoriaController {


  

        public function index() {
        $model = new Categoria();
        $categorias = $model->obtenerCategorias();
        require __DIR__ . '/../../views/categoria/indexCategoria.php';
    }

    public function crearForm() {
        require __DIR__ . '/../../views/categoria/crearCategoria.php';
    }

    public function crear() {
        $nombre = trim($_POST['nombre'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');
        $model = new Categoria();
        if ($model->guardar($nombre, $descripcion)) {
            header('Location: /dashboard/categorias'); exit;
        } else {
            echo "<script>alert('Error al guardar categoría'); window.history.back();</script>";
        }
    }

    public function editarForm() {
        $id = (int)($_GET['id'] ?? 0);
        $model = new Categoria();
        $categoria = $model->obtenerPorId($id);
        require __DIR__ . '/../../views/categoria/editarCategoria.php';
    }

    public function editar() {
        $id = (int)($_POST['id'] ?? 0);
        $nombre = trim($_POST['nombre'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');
        $model = new Categoria();
        if ($model->actualizar($id, $nombre, $descripcion)) {
            header('Location: /dashboard/categorias'); exit;
        } else {
            echo "<script>alert('Error al actualizar categoría'); window.history.back();</script>";
        }
    }

    public function eliminar() {
        $id = (int)($_POST['id'] ?? 0);
        $model = new Categoria();
        $model->eliminar($id);
        header('Location: /dashboard/categorias'); exit;
    }
    
        }
        
    
    

    
