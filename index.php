<?php
session_start();

// Dependencias
require_once './vendor/autoload.php';
// Incluir la clase Route
require_once './src/routes/Route.php';


use Dotenv\Dotenv;

// Cargar el archivo .env
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Modo Debug
if ($_ENV['DEV_MODE'] === 'dev') {
  ini_set('display_errors', 1);
  error_reporting(E_ALL);
}

// Iniacialización de rutas
$route = new Route($_ENV['BASE_URL']);

// Incluir los archivos de rutas
require_once './src/routes/auth.php';
require_once './src/routes/home.php';
require_once './src/routes/news.php';

// Manejar las rutas después de registrarlas
$route->handle();
