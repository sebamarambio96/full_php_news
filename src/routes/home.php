<?php
require_once './src/routes/Route.php';
require_once './src/controllers/views/HomeController.php';

global $route;

$route->group('/home', function ($route) {
    $route->get('', function () {
        $controller = new HomeController();
        $controller->index();
    });
});
