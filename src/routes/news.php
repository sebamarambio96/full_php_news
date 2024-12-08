<?php
require_once './src/routes/Route.php';
require_once './src/controllers/views/NewsController.php';

global $route;

$route->group('/news', function ($route) {
    $route->get('/create', function () {
        $controller = new NewsController();
        $controller->showCreatePage();
    });

    $route->post('/create', function () {
        $controller = new NewsController();
        $controller->store();
    });

    $route->get('/edit/:id', function($params) {
        $controller = new NewsController();
        $controller->showEditPage($params['id']);
    });
    
    $route->post('/edit/:id', function($params) {
        $controller = new NewsController();
        $controller->update($params['id']);
    });

    $route->get('/:id', function ($params) {
        $controller = new NewsController();
        $controller->showById($params['id']);
    });

    $route->post('/delete/:id', function($params) {
        $controller = new NewsController();
        $controller->delete($params['id']);
    });
});