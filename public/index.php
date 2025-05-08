<?php

// index.php
require_once __DIR__ . '/../routes/routesWeb.php';

$router = new Router();

//Rutas para el AuthController
$router->add('GET', '/', ['AuthController', 'login']);
$router->add('POST', '/login', ['AuthController', 'autenticar']);
$router->add('GET', '/registrer', ['AuthController', 'registrer']);
$router->add('POST', '/register', ['AuthController', 'register']);

//Rutas para el Dashboard
$router->add('GET', '/dashboard', ['DashboardController', 'index']);


//Rutas para Productos
$router->add('GET', '/dashboard/productos', ['DashboardProductoController', 'dashboard']);
$router->add('GET', '/producto/crear', ['ProductoController', 'index']);
$router->add('POST', '/guardar', ['ProductoController', 'guardar']);

// Rutas Dinámicas Productos
$router->add('GET', '/producto/editar/', ['ProductoController', 'editar']);

$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$router->dispatch($method, $uri);
