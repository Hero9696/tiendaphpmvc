<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require_once __DIR__ . '/../middleware/auth.php'; // Asegúrate de que la ruta sea correcta
class ProductoController {

    public function index() {
verificarToken(); // Verifica el token antes de continuar
        
        if (!isset($_COOKIE['token'])) {
            header("Location: /");
            exit();
        }
    
        require_once __DIR__ . '/../../vendor/autoload.php';
       
    
        try {
            $decoded = JWT::decode($_COOKIE['token'], new Key('clave_secreta_segura', 'HS256'));
            // Token válido, muestra la vista
            ob_start();  require_once __DIR__ . '/../models/modelCategoria.php';
            $categoriaModel = new Categoria();
            $categorias = $categoriaModel->obtenerCategorias();
            require __DIR__ . '/../../views/producto/producto.php';
            $content = ob_get_clean();
            $title = "Crear Producto";
            require_once __DIR__ . '/../../views/layout/layout.php';
        } catch (Exception $e) {
            // Token expirado o inválido
            echo "<script>
                    alert('Su sesión ha expirado. Será redirigido al login.');
                    window.location.href = '/';
                  </script>";
            exit();
        }
            
        }

        public function guardar() {
            $nombre = $_POST['nombre'];
            $codigo = $_POST['codigo'];
            $precio_compra = $_POST['precio_compra'];
            $precio_venta = $_POST['precio_venta'];
            $stock = $_POST['stock'];
            $id_categoria = $_POST['id_categoria'];
        
            require_once __DIR__ . '/../models/modelProducto.php';
            $producto = new Producto();
            $producto->guardar($nombre, $codigo, $precio_compra,$precio_venta, $stock,$id_categoria);
        
            header('Location:/producto/crear ');
        }

       
        

      
        

        
        
    
    

    
    private function render($view) {
        ob_start();  // Inicia la captura de salida
        require_once __DIR__ . '/../../public/views/' . $view;  // Incluye la vista especificada
        return ob_get_clean();  // Devuelve el contenido generado
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php?c=Auth&a=login");
    }
}
