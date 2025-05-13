<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require_once __DIR__ . '/../middleware/auth.php'; // Asegúrate de que la ruta sea correcta
class DashboardProductoController {
    // Método para mostrar el dashboard de productos
public function dashboard() {
    verificarToken(); // Verifica el token antes de continuar

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

 public function exportCsv() {
        // Leer filtros
        $search      = $_GET['search']       ?? '';
        $stockFilter = $_GET['stock_filter'] ?? '';
        $categoriaId = $_GET['categoria']    ?? '';

        // Cargar modelo y obtener datos
        require_once __DIR__ . '/../models/modelProducto.php';
        $productos = (new Producto())
            ->obtenerProductosFiltrados($search,$stockFilter,$categoriaId);

        // Cabeceras CSV
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=productos.csv');

        $out = fopen('php://output', 'w');
        // Fila de títulos
        fputcsv($out, ['ID','Nombre','Código','Categoría','Stock','Precio Compra','Precio Venta']);
        // Datos
        foreach ($productos as $p) {
            fputcsv($out, [
                $p['id'],
                $p['nombre'],
                $p['codigo'],
                $p['categoria_nombre'],
                $p['stock'],
                number_format($p['precio_compra'],2),
                number_format($p['precio_venta'],2),
            ]);
        }
        fclose($out);
        exit;
    }

     public function exportExcel() {
        // Leer filtros
        $search      = $_GET['search']       ?? '';
        $stockFilter = $_GET['stock_filter'] ?? '';
        $categoriaId = $_GET['categoria']    ?? '';

        require_once __DIR__ . '/../models/modelProducto.php';
        $productos = (new Producto())
            ->obtenerProductosFiltrados($search,$stockFilter,$categoriaId);

        // Necesita: composer require phpoffice/phpspreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // Títulos
        $sheet->fromArray(
            ['ID','Nombre','Código','Categoría','Stock','Precio Compra','Precio Venta'],
            NULL, 'A1'
        );
        // Datos a partir de la fila 2
        $row = 2;
        foreach ($productos as $p) {
            $sheet->fromArray([
                $p['id'],
                $p['nombre'],
                $p['codigo'],
                $p['categoria_nombre'],
                $p['stock'],
                number_format($p['precio_compra'],2),
                number_format($p['precio_venta'],2),
            ], NULL, "A{$row}");
            $row++;
        }

        // Enviar al navegador
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename=productos.xlsx');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    }