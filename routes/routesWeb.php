<?php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($uri) {
    case '/':
        require_once __DIR__ . '/../api/controllers/AuthController.php';
        $controller = new AuthController();
        $controller->login();
        break;
    case '/login':
        require_once __DIR__ . '/../api/controllers/AuthController.php';
        $controller = new AuthController();
        $controller->autenticar();
        break;

        case '/registrer':
            require_once __DIR__ . '/../api/controllers/AuthController.php';
            $controller = new AuthController();
            $controller->registrer();
            break;
            case '/register':
                require_once __DIR__ . '/../api/controllers/AuthController.php';
                $controller = new AuthController();
                $controller->register();
                break;

                case '/dashboard':
                    require_once __DIR__ . '/../api/controllers/DashboardController.php';
                    $controller = new DashboardController();
                    $controller->index();
                    break;

                    case '/productos':
                        require_once __DIR__ . '/../api/controllers/ProductoController.php';
                        $controller = new ProductoController();
                        $controller->index();
                        break;

                        case '/guardar':
                            require_once __DIR__ . '/../api/controllers/ProductoController.php';
                            $controller = new ProductoController();
                            $controller->guardar();
                            break;
    
    default:
        http_response_code(404);
        echo "Página no encontrada";
        break;
}
