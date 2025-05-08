<?php
class Router {
    private $routes = [];

    public function add($method, $path, $handler) {
        $this->routes[] = compact('method', 'path', 'handler');
    }

    public function dispatch($method, $uri) {
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && preg_match($this->convertToRegex($route['path']), $uri, $matches)) {
                require_once __DIR__ . '/../api/controllers/' . $route['handler'][0] . '.php';
                $controllerName = $route['handler'][0];
                $methodName = $route['handler'][1];
                $controller = new $controllerName();

                return call_user_func_array([$controller, $methodName], array_slice($matches, 1));
            }
        }

        http_response_code(404);
        echo "Página no encontrada";
    }

    private function convertToRegex($path) {
        return '#^' . preg_replace('#\{([\w]+)\}#', '([\w-]+)', $path) . '$#';
    }
}
