<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require_once __DIR__ . '/../middleware/auth.php'; // Asegúrate de que la ruta sea correcta
class DashboardProductoController {
    // Método para mostrar el dashboard de productos
  public function dashboard() {
        // 1) Verificar JWT y renovar si hace falta
        $user = verificarToken(true);

        // 2) Leer filtros desde la URL (GET)
        $search      = $_GET['search']       ?? '';
        $stockFilter = $_GET['stock_filter'] ?? '';
        $categoriaId = $_GET['categoria']    ?? '';

        // 3) Cargar modelos
        require_once __DIR__ . '/../models/modelCategoria.php';
        require_once __DIR__ . '/../models/modelProducto.php';
        $categoriaModel = new Categoria();
        $productoModel  = new Producto();

        // 4) Obtener datos
        $categorias = $categoriaModel->obtenerCategorias();
        $productos  = $productoModel->obtenerProductosFiltrados(
            $search,
            $stockFilter,
            $categoriaId
        );

        // 5) Renderizar la vista con layout
        ob_start();
        require __DIR__ . '/../../views/dashboard/dashboardproductos.php';
        $content = ob_get_clean();
        $title   = "Dashboard de Productos";
        require_once __DIR__ . '/../../views/layout/layout.php';
    }
    }