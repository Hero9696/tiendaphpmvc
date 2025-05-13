<?php
// controllers/AuthController.php
require_once __DIR__ . '/../models/modelUsuario.php';
require_once __DIR__ . '/../models/modelRol.php';
require_once __DIR__ . '/../../vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthController {
    public function login() {
        $content = $this->render('auth/login.php');
        $title   = 'Iniciar Sesión';
        require_once __DIR__ . '/../../views/layout/layoutLogin.php';
    }

    public function registerform() {
        // 1) Cargar roles
        $rolModel = new Rol();
        $roles = $rolModel->obtenerRoles();

        // 2) Renderizar vista de registro con los roles disponibles
        $content = $this->render('auth/registrer.php', ['roles' => $roles]);
        $title   = 'Registro';
        require_once __DIR__ . '/../../views/layout/layoutLogin.php';
    }

    public function autenticar() {
        $usuario = trim($_POST['usuario'] ?? '');
        $clave   = $_POST['clave']   ?? '';

        if (!$usuario || !$clave) {
            $this->redirectWithError('/', 'Usuario y contraseña son obligatorios');
            return;
        }

        $model = new Usuario();
        $datos = $model->verificar($usuario, $clave);

        if ($datos) {
            $key = 'clave_secreta_segura';
            $payload = [
                'sub'     => $datos['id'],
                'usuario' => $datos['usuario'],
                'rol'     => $datos['id_rol'],
                'exp'     => time() + 6000
            ];

            $jwt = JWT::encode($payload, $key, 'HS256');
            setcookie('token', $jwt, time() + 6000, '/');
            header('Location: /dashboard');
            exit;
        } else {
            $this->redirectWithError('/', 'Credenciales inválidas o usuario inactivo');
        }
    }

    public function register() {
        $nombre  = trim($_POST['nombre']  ?? '');
        $usuario = trim($_POST['usuario'] ?? '');
        $email   = trim($_POST['email']   ?? '');
        $clave   = $_POST['clave']        ?? '';
        $rol     = (int)($_POST['rol']    ?? 2);

        if (!$nombre || !$usuario || !$email || !$clave) {
            $this->redirectWithError('/registerform', 'Todos los campos son obligatorios');
            return;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->redirectWithError('/registerform', 'El correo no es válido');
            return;
        }

        $model = new Usuario();
        try {
            $model->registrar($nombre, $usuario, $email, $clave, $rol);
            header('Location: /');
            exit;
        } catch (Exception $e) {
            $this->redirectWithError('/register', $e->getMessage());
        }
    }

    public function logout() {
        setcookie('token', '', time() - 3600, '/');
        header('Location: /');
        exit;
    }

    /**
     * Renderiza una vista pasando datos al scope
     * @param string $view Ruta relativa dentro de views/
     * @param array  $data Variables a extraer en la vista
     * @return string HTML renderizado
     */
    private function render(string $view, array $data = []): string {
        extract($data);
        ob_start();
        require __DIR__ . '/../../views/' . $view;
        return ob_get_clean();
    }

    /**
     * Redirige con un mensaje de error en alerta
     */
    private function redirectWithError(string $url, string $message): void {
        echo "<script>alert('" . addslashes($message) . "'); window.location.href='" . $url . "';</script>";
        exit;
    }
}
