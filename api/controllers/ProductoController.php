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
            require __DIR__ . '/../../views/producto/crearProducto.php';
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
         public function editar() {
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
            require __DIR__ . '/../../views/producto/editarProducto.php';
            $content = ob_get_clean();
            $title = "Editar Producto";
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
public function actualizar() {
    // 1) Leer todos los campos, incluido el id
    $id             = $_POST['id'];
    $nombre         = $_POST['nombre'];
    $codigo         = $_POST['codigo'];
    $precio_compra  = $_POST['precio_compra'];
    $precio_venta   = $_POST['precio_venta'];
    $stock          = $_POST['stock'];
    $id_categoria   = $_POST['id_categoria'];

    // 2) Actualizar el producto
    require_once __DIR__ . '/../models/modelProducto.php';
    $producto = new Producto();
    $ok = $producto->actualizar(
        $nombre,
        $codigo,
        (float)$precio_compra,
        (float)$precio_venta,
        (int)$stock,
        (int)$id_categoria
    );

    // 3) Redirect-Get de vuelta a la edición, pasando el código
    if ($ok) {
              header('Location: /producto/editar');
        exit;
    } else {
        // En caso de fallo, podrías volver atrás con JS
        echo "<script>
                alert('Error al actualizar el producto.');
                window.history.back();
              </script>";
              
        exit;
    }
}


       
        
public function buscarPorCodigo() {
    // 1. Obtén el código de la URL, si no existe usa cadena vacía
    $codigo = $_GET['codigo'] ?? '';

    // 2. Carga modelos
    require_once __DIR__ . '/../models/modelProducto.php';
    require_once __DIR__ . '/../models/modelCategoria.php';
    $productoModel  = new Producto();
    $categoriaModel = new Categoria();

    // 3. Si no se pasó código, no invocas al modelo
    if ($codigo === '') {
        $producto   = null;
    } else {
        // Forzar a string por seguridad
        $producto = $productoModel->obtenerPorCodigo($codigo);
    }

    // 4. Obtiene siempre las categorías
    $categorias = $categoriaModel->obtenerCategorias();

    // 5. Renderiza la vista (producto/editar.php) con ambas variables
    require_once __DIR__ . '/../../views/producto/editarProducto.php';
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
