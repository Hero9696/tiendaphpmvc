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


// Rutas para Categorías
// Listar todas las categorías en el dashboard
$router->add('GET',  '/dashboard/categorias', ['CategoriaController', 'index']);

// Formulario de creación
$router->add('GET',  '/categoria/crear',     ['CategoriaController', 'crearForm']);
// Procesar creación
$router->add('POST', '/categoria/crear',     ['CategoriaController', 'crear']);

// Formulario de edición (recibe ?id=XX)
$router->add('GET',  '/categoria/editar',    ['CategoriaController', 'editarForm']);
// Procesar edición
$router->add('POST', '/categoria/editar',    ['CategoriaController', 'editar']);

// Procesar eliminación
$router->add('POST', '/categoria/eliminar',  ['CategoriaController', 'eliminar']);

// Rutas para Proveedores
// Listado de proveedores en el dashboard
$router->add('GET',  '/proveedores',    ['ProveedorController', 'index']);

// Formulario de creación
$router->add('GET',  '/proveedor/crear',         ['ProveedorController', 'crearForm']);
// Procesar creación
$router->add('POST', '/proveedor/crear',         ['ProveedorController', 'crear']);

// Formulario de edición (recibe ?id=XX)
$router->add('GET',  '/proveedor/editar',        ['ProveedorController', 'editarForm']);
// Procesar edición
$router->add('POST', '/proveedor/editar',        ['ProveedorController', 'editar']);

// Procesar eliminación
$router->add('POST', '/proveedor/eliminar',      ['ProveedorController', 'eliminar']);  



$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$router->dispatch($method, $uri);
