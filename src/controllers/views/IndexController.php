<?php

require_once './src/middleware/AuthMiddleware.php';
require_once './src/controllers/views/HomeController.php';

class IndexController
{

    public function __construct()
    {
        /*  */
    }

    public function index($info = '')
    {
        $isAuthenticated = AuthMiddleware::isAuthenticated();

        // Si esta autenticado redirigir al home
        if ($isAuthenticated) {
            (new HomeController)->index();
            exit();
        }

        // Mensaje de error al iniciar sesión
        if (isset($_SESSION['login_error'])) {
            $loginError = $_SESSION['login_error'];
            unset($_SESSION['login_error']);
        } else {
            $loginError = '';
        }

        // Mensaje de éxito al registrarse
        if (isset($_SESSION['register_success'])) {
            $registerSuccess = $_SESSION['register_success'];
            unset($_SESSION['register_success']);
        } else {
            $registerSuccess = '';
        }

        // Mensaje de información
        if (isset($_SESSION['info_message']) || !empty($info)) {
            $infoMessage = $_SESSION['info_message'] ?? $info;
            unset($_SESSION['info_message']);
        } else {
            $infoMessage = '';
        }

        // Llamar a la vista
        require_once './src/views/login.php';
    }
}
