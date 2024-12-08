<?php

require_once './src/models/PageInfo.php';
require_once './src/models/News.php';
require_once './src/models/User.php';
require_once './src/helpers/Auth/AuthToken.php';
require_once './src/controllers/views/IndexController.php';
require_once './src/middleware/AuthMiddleware.php';

class HomeController
{
    use AuthToken;

    private $pageModel;
    private $newsModel;
    private $userModel;

    public function __construct()
    {
        $this->pageModel = new PageInfo();
        $this->newsModel = new News();
        $this->userModel = new User();
    }

    public function index()
    {
        $userId = AuthMiddleware::getToken();

        // Obtener datos de la página
        $pageInfo = $this->pageModel->getPageById(1);
        $titulo = $pageInfo['titulo'] ?? 'Título no encontrado';
        $descripcion = $pageInfo['descripcion'] ?? 'Descripción no encontrada';

        // Obtener la fecha de nacimiento del usuario
        $userModel = new User();
        $userInfo = $userModel->getUserById($userId);
        $dateOfBirth = $userInfo['fecha_nacimiento'];

        // Calcular la edad del usuario
        $age = $this->calculateAge($dateOfBirth);

        // Obtener datos de la página
        $pageInfo = $this->pageModel->getPageById(1);

        // Verificar si el usuario es mayor de edad
        if ($age < 18) {
            // Si es menor de edad, mostrar contenido para menores
            $titulo = 'Contenido para menores de edad';
            $descripcion = 'Contenido adecuado para menores de 18 años.';
        }

        // Obtener noticias
        $news = $this->newsModel->getAll();

        // Llamar a la vista
        require_once './src/views/home.php';
    }

    private function calculateAge($dateOfBirth)
    {
        $dateOfBirth = new DateTime($dateOfBirth);
        $today = new DateTime();
        $age = $today->diff($dateOfBirth);
        return $age->y;
    }
}
