<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
class DashboardProductoController {
    // Método para mostrar el dashboard de productos
 public function dashboard() {
            // Verificar que el token es válido
            if (!isset($_COOKIE['token'])) {
                header("Location: /");
                exit();
            }
        
            require_once __DIR__ . '/../../vendor/autoload.php';
        
            try {
                // Verificar el token JWT
                $decoded = JWT::decode($_COOKIE['token'], new Key('clave_secreta_segura', 'HS256'));
        
                // Obtener los productos desde el modelo
                require_once __DIR__ . '/../models/modelProducto.php';
                $productoModel = new Producto();
                $productos = $productoModel->obtenerProductosOrdenadosPorStock();
        
                // Mostrar la vista
                ob_start();
                require __DIR__ . '/../../views/dashboard/dashboardproductos.php';
                $content = ob_get_clean();
                $title = "Dashboard de Productos";
                require_once __DIR__ . '/../../views/layout/layout.php';
            } catch (Exception $e) {
                // Si el token es inválido o ha expirado
                echo "<script>
                        alert('Su sesión ha expirado. Será redirigido al login.');
                        window.location.href = '/';
                      </script>";
                exit();
            }
        }
    }