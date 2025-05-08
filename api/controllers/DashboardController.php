<?php
require_once __DIR__ . '/../models/modelVenta.php';
require_once __DIR__ . '/../models/modelGasto.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class DashboardController {

    public function index() {
         // Instanciar modelos
         $ventaModel = new Venta();
         $gastoModel = new Gasto();
 
         // Obtener totales
         $totalVentas = $ventaModel->obtenerTotalVentas();
         $totalGastos = $gastoModel->obtenerTotalGastos();
        if (!isset($_COOKIE['token'])) {
            header("Location: /");
            exit();
        }
    
        require_once __DIR__ . '/../../vendor/autoload.php';
       
    
        try {
            $decoded = JWT::decode($_COOKIE['token'], new Key('clave_secreta_segura', 'HS256'));
            // Token válido, muestra la vista
            ob_start();
            require __DIR__ . '/../../public/views/dashboard/dashboard.php';
            $content = ob_get_clean();
            $title = "Dashboard"; // Establece el título de la página
            require_once __DIR__ . '/../../public/views/layout/layout.php';
        } catch (Exception $e) {
            // Token expirado o inválido
            echo "<script>
                    alert('Su sesión ha expirado. Será redirigido al login.');
                    window.location.href = '/';
                  </script>";
            exit();
        }
            
            // Renderiza la vista del chat
           // $content = $this->render('chat/chat.php');
           // $title = 'Chat';  // Establece el título de la página
           // require_once __DIR__ . '/../layout/layout.php';  // Incluye el layout con el contenido
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
