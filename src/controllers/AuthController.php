<?php
require_once './src/models/User.php';
require_once './src/helpers/Auth/AuthToken.php';

class AuthController
{
  use AuthToken;

  private $userModel;

  public function __construct()
  {
    $this->userModel = new User();
  }

  public function login($data)
  {
    $usernameOrEmail = $data['username'];
    $password = $data['password'];

    // Primero intentamos buscar por nombre de usuario
    $user = $this->userModel->getUserByUsername($usernameOrEmail);

    // Si no encontramos por nombre de usuario, intentamos por correo electrónico
    if (!$user) {
      $user = $this->userModel->getUserByEmail($usernameOrEmail);
    }

    // Verificamos si el usuario existe y si la contraseña es correcta
    if ($user && password_verify($password, $user['password'])) {
      // Encriptamos el user_id
      $encryptedUserId = self::encrypt($user['id']);

      // Guardamos el "auth token" (el user_id encriptado)
      $_SESSION['auth_token'] = $encryptedUserId;

      // Redirigir al home después de un inicio de sesión exitoso
      header('Location: ' . $_ENV['BASE_URL'] . '/home');
      exit();
    } else {
      // Guardamos el mensaje de error en la sesión
      $_SESSION['login_error'] = 'Credenciales incorrectas.';

      // Redirigimos al login con el mensaje de error
      header('Location: ' . $_ENV['BASE_URL'] . '/');
      exit();
    }
  }

  public function register($data)
  {
    // Recibir los datos del formulario
    $username = $data['reg_username'];
    $email = $data['reg_email'];
    $password = password_hash($data['reg_password'], PASSWORD_BCRYPT);
    $allName = $data['reg_nombre_completo'];
    $fechaNacimiento = $data['reg_fecha_nacimiento'];

    // Verificar si el nombre de usuario o el correo electrónico ya están registrados
    if ($this->userModel->getUserByUsername($username)) {
      $_SESSION['register_error'] = "El nombre de usuario ya está registrado.";
      header('Location: ' . $_ENV['BASE_URL'] . '/register');
      exit();
    }

    if ($this->userModel->getUserByEmail($email)) {
      $_SESSION['register_error'] = "El correo electrónico ya está registrado.";
      header('Location: ' . $_ENV['BASE_URL'] . '/register');
      exit();
    }

    // Crear el usuario en la base de datos, incluyendo la fecha de nacimiento
    if ($this->userModel->createUser($username, $allName, $email, $password, $fechaNacimiento)) {
      $_SESSION['register_success'] = "Registro exitoso. Por favor, inicia sesión.";
      header('Location: ' . $_ENV['BASE_URL'] . '/');
    } else {
      $_SESSION['register_error'] = "Error inesperado al registrar al usuario.";
      header('Location: ' . $_ENV['BASE_URL'] . '/register');
      exit();
    }
  }


  public function logout()
  {
    session_unset();
    $_SESSION['info_message'] = "Has cerrado la sesión, nos vemos luego.";

    header('Location: ' . $_ENV['BASE_URL'] . '/');
    exit();
  }
}
