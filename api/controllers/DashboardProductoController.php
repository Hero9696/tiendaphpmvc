<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require_once __DIR__ . '/../middleware/auth.php'; // Asegúrate de que la ruta sea correcta
class DashboardProductoController {
    // Método para mostrar el dashboard de productos
public function dashboard() {
    $user = verificarToken(true);

    // 1) Leer filtros + página
    $search      = $_GET['search']       ?? '';
    $stockFilter = $_GET['stock_filter'] ?? '';
    $categoriaId = $_GET['categoria']    ?? '';
    $currentPage = max(1, (int)($_GET['page'] ?? 1));
    $perPage     = 10;  // filas por página
    $offset      = ($currentPage - 1) * $perPage;

    // 2) Modelos
    require_once __DIR__ . '/../models/modelCategoria.php';
    require_once __DIR__ . '/../models/modelProducto.php';
    $categoriaModel = new Categoria();
    $productoModel  = new Producto();

    // 3) Contar total y obtener página
    $totalItems  = $productoModel->contarFiltrados($search, $stockFilter, $categoriaId);
    $totalPages  = (int)ceil($totalItems / $perPage);
    $categorias  = $categoriaModel->obtenerCategorias();
    $productos   = $productoModel->obtenerPagina($search, $stockFilter, $categoriaId, $perPage, $offset);

    // 4) Renderizar
    ob_start();
    require __DIR__ . '/../../views/dashboard/dashboardproductos.php';
    $content = ob_get_clean();
    $title   = "Dashboard de Productos";
    require_once __DIR__ . '/../../views/layout/layout.php';
}

    }