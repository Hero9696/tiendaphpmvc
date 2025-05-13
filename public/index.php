<?php

// index.php
require_once __DIR__ . '/../routes/routesWeb.php';

$router = new Router();

//Rutas para el AuthController
$router->add('GET', '/', ['AuthController', 'login']);
$router->add('POST', '/login', ['AuthController', 'autenticar']);
$router->add('GET', '/registerform', ['AuthController', 'registerform']);
$router->add('POST', '/register', ['AuthController', 'register']);
$router->add('GET', '/logout', ['AuthController', 'logout']);

//Rutas para el Dashboard
$router->add('GET', '/dashboard', ['DashboardController', 'index']);


//Rutas para Productos
$router->add('GET', '/dashboard/productos', ['DashboardProductoController', 'dashboard']);
$router->add('GET', '/producto/crear', ['ProductoController', 'index']);
$router->add('GET', '/producto/editar', ['ProductoController', 'editar']);
$router->add('POST', '/guardar', ['ProductoController', 'guardar']);
$router->add('GET', '/buscar', ['ProductoController', 'buscarPorCodigo']);
$router->add('POST', '/producto/actualizar', ['ProductoController', 'actualizar']);
$router->add('GET', '/producto/export/csv', ['DashboardProductoController', 'exportCsv']);
$router->add('GET', '/producto/export/excel', ['DashboardProductoController', 'exportExcel']);



$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$router->dispatch($method, $uri);
