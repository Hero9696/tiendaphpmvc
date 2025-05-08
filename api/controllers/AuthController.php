<?php
require_once __DIR__ . '/../models/Usuario.php'; // Asegúrate de que la ruta sea correcta
require_once __DIR__ . '/../../vendor/autoload.php'; // Asegúrate de que la ruta sea correcta
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthController {


    public function login() {
        
        $content = $this->render('auth/login.php');  // Renderiza la vista del registro
        $title = 'Login';  // Establece el título de la página
        require_once __DIR__ . '/../../public/views/layout/layout.php';  // Incluye el layout con el contenido
    }

    public function autenticar() {
        $user = new Usuario();
        if ($user->verificar($_POST['usuario'], $_POST['clave'])) {
            $key = "clave_secreta_segura";
            $payload = [
                "usuario" => $_POST['usuario'],
                "exp" => time() + 600 // 10 minutos
            ];
    
            $jwt = JWT::encode($payload, $key, 'HS256');
            setcookie("token", $jwt, time() + 600, "/"); // cookie válida por 10 min
    
            header("Location: /dashboard"); // Redirige al dashboard después de iniciar sesión
        } else {
            echo "<script>alert('Usuario o contraseña incorrectos'); window.location.href='/'</script>";
        }
    }

      // Método para mostrar la página de registro
      public function registrer() {
        $content = $this->render('auth/registrer.php');  // Renderiza la vista del registro
        $title = 'Registro';  // Establece el título de la página
        require_once __DIR__ . '/../../public/views/layout/layout.php';  // Incluye el layout con el contenido
    }

    public function register() {
        $user = new Usuario();
        $user->registrar($_POST['nombre'], $_POST['usuario'], $_POST['clave'], $_POST['rol']);  // Llama al método de registro del modelo Usuario
        header("Location: /");  // Redirige al login después de registrar al usuario
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
