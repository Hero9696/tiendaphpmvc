<?php

use PhpOffice\PhpSpreadsheet\Writer\Ods\Content;

require_once __DIR__ . '/../models/modelProveedor.php';

class ProveedorController {
    /**
     * Muestra la lista de proveedores
     */
    public function index() {
            ob_start();
             $model = new Proveedor();
        $proveedores = $model->obtenerProveedores();
   require __DIR__ . '/../../views/proveedor/indexProveedor.php';
    $content = ob_get_clean();
    $title   = "Dashboard de Proveedores";
    require_once __DIR__ . '/../../views/layout/layout.php';
    }

    /**
     * Formulario para crear un nuevo proveedor
     */
    public function crearForm() {
        ob_start();
        require __DIR__ . '/../../views/proveedor/crearProveedor.php';
        $content = ob_get_clean();
        $title="Crear Proveedor";
         require_once __DIR__ . '/../../views/layout/layout.php';

    }

    /**
     * Procesa la creación de un proveedor
     */
    public function crear() {
        $nombre   = trim($_POST['nombre'] ?? '');
        $contacto = trim($_POST['contacto'] ?? '');
        $telefono = trim($_POST['telefono'] ?? '');
        $email    = trim($_POST['email'] ?? '');

        $model = new Proveedor();
        if ($model->guardar($nombre, $contacto, $telefono, $email)) {
            header('Location: /proveedores');
            exit;
        } else {
            echo "<script>alert('Error al guardar proveedor'); window.history.back();</script>";
        }
    }

    /**
     * Formulario para editar un proveedor existente
     */
    public function editarForm() {
        ob_start();
        $id = (int) ($_GET['id'] ?? 0);
        $model = new Proveedor();
        $proveedor = $model->obtenerPorId($id);
        require __DIR__ . '/../../views/proveedor/editarProveedor.php';
         $content = ob_get_clean();
        $title="Editar Proveedor";
         require_once __DIR__ . '/../../views/layout/layout.php';
    }

    /**
     * Procesa la actualización de un proveedor
     */
    public function editar() {
        $id       = (int) ($_POST['id'] ?? 0);
        $nombre   = trim($_POST['nombre'] ?? '');
        $contacto = trim($_POST['contacto'] ?? '');
        $telefono = trim($_POST['telefono'] ?? '');
        $email    = trim($_POST['email'] ?? '');

        $model = new Proveedor();
        if ($model->actualizar($id, $nombre, $contacto, $telefono, $email)) {
            header('Location: /proveedores');
            exit;
        } else {
            echo "<script>alert('Error al actualizar proveedor'); window.history.back();</script>";
        }
    }

    /**
     * Elimina un proveedor
     */
    public function eliminar() {
        $id = (int) ($_POST['id'] ?? 0);
        $model = new Proveedor();
        $model->eliminar($id);
        header('Location: /proveedores');
        exit;
    }

     private function render($view) {
        ob_start();  // Inicia la captura de salida
        require_once __DIR__ . '/../../views' . $view;  // Incluye la vista especificada
        return ob_get_clean();  // Devuelve el contenido generado
    }
}
