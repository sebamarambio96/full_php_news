<?php
require_once './src/routes/Route.php';
require_once './src/controllers/views/HomeController.php';
require_once './src/controllers/views/IndexController.php';
require_once './src/controllers/AuthController.php';

global $route;

// Página de login
$route->get('/', function () {
    $controller = new IndexController();
    $controller->index();
});

// Formulario Login
$route->post('/login', function () {
    require_once './src/controllers/AuthController.php';
    $authController = new AuthController();
    $authController->login($_POST);
});

// Página de registro
$route->get('/register', function () {
    error_log("Accedió a la ruta /register");
    require_once './src/views/register.php';
});

// Formulario de registro
$route->post('/register', function () {
    require_once './src/controllers/AuthController.php';
    $authController = new AuthController();
    $authController->register($_POST);
});

// Cerrar sesión
$route->get('/logout', function () {
    require_once './src/controllers/AuthController.php';
    $authController = new AuthController();
    $authController->logout();
});