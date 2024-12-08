<?php

class IndexController
{

    public function __construct()
    {
        /*  */
    }

    public function index()
    {
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
        if (isset($_SESSION['info_message'])) {
            $infoMessage = $_SESSION['info_message'];
            unset($_SESSION['info_message']);
        } else {
            $infoMessage = '';
        }

        // Llamar a la vista
        require_once './src/views/login.php';
    }
}
