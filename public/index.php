<?php

// index.php
require_once __DIR__ . '/../routes/routesWeb.php';

$router = new Router();

$router->add('GET', '/', ['AuthController', 'login']);
$router->add('POST', '/login', ['AuthController', 'autenticar']);
$router->add('GET', '/registrer', ['AuthController', 'registrer']);
$router->add('POST', '/register', ['AuthController', 'register']);

$router->add('GET', '/dashboard', ['DashboardController', 'index']);
$router->add('GET', '/dashboard/productos', ['DashboardProductoController', 'dashboard']);
$router->add('GET', '/productos', ['ProductoController', 'index']);
$router->add('POST', '/guardar', ['ProductoController', 'guardar']);

// rutas dinámicas (ejemplo)
$router->add('GET', '/producto/editar/{id}', ['ProductoController', 'editar']);

$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$router->dispatch($method, $uri);
