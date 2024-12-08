<?php
require_once './src/helpers/Auth/AuthToken.php';

class AuthMiddleware
{
    use AuthToken;

    // Verifica si el usuario está autenticado
    public static function getToken()
    {
        if (self::isAuthenticated()) {
            $userId = self::decrypt($_SESSION['auth_token']);
            return $userId;
        } else {
            // Si no hay un auth_token, redirigimos o mostramos un error
            (new IndexController())->index("Debes iniciar sesión para entrar a esta página.");
            exit();
        }
    }

    // Verifica si el usuario está autenticado
    public static function check()
    {
        if (!self::isAuthenticated()) {
            // Si no hay un auth_token, redirigimos o mostramos un error
            (new IndexController())->index("Debes iniciar sesión para entrar a esta página.");
            exit();
        }
    }

    public static function clearSession()
    {
        // Eliminar la info de la sesión
        session_unset();
    }

    // Verificar si el usuario está logueado
    public static function isAuthenticated()
    {
        // Verificamos si existe el auth token en la sesión
        if (isset($_SESSION['auth_token'])) {
            $userId = self::decrypt($_SESSION['auth_token']);

            // Verificamos si el user_id es válido
            if ($userId) {
                return true;
            }
        }

        // Si no está autenticado, retornamos null o falso
        return false;
    }
}
