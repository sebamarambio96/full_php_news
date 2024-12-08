<?php
require_once './src/models/News.php';
require_once './src/middleware/AuthMiddleware.php';

class NewsController
{
  private $newsModel;

  public function __construct()
  {
    $this->newsModel = new News();
  }

  // Página de detalle de una noticia
  public function showById($id)
  {
    $news = $this->newsModel->getById($id);
    if (!$news) {
      http_response_code(404);
      require_once './src/views/errors/404.php';
    }

    // Renderizar la vista de detalle
    require_once './src/views/news/detail.php';
  }

  // Mostrar la página de creación de noticias
  public function showCreatePage($success = '', $error = '')
  {
    $error = $error;
    $success = $success;
    $news = $this->newsModel->getAll();

    // Renderizar la vista de creación
    require_once './src/views/news/create.php';
  }

  // Manejar la creación de noticias
  public function store()
  {
    $error = '';
    $success = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $titulo = trim($_POST['titulo']);
      $contenido = trim($_POST['contenido']);
      $autor = trim($_POST['autor']);
      $imagen = $_FILES['imagen']['name'];

      if ($imagen) {
        $target_dir = "./public/assets/img/";
        $target_file = $target_dir . basename($imagen);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validar imagen
        $check = getimagesize($_FILES['imagen']['tmp_name']);
        if ($check === false) {
          $error = "El archivo no es una imagen.";
        } elseif (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
          $error = "Solo se permiten imágenes en formato JPG, JPEG, PNG y GIF.";
        } elseif ($_FILES['imagen']['size'] > 2 * 1024 * 1024) {
          $error = "El tamaño máximo permitido para las imágenes es 2 MB.";
        } else {
          // Subir imagen y guardar la ruta en la base de datos
          if (move_uploaded_file($_FILES['imagen']['tmp_name'], $target_file)) {
            try {
              $this->newsModel->create($titulo, $contenido, '/public/assets/img/' . $imagen, $autor);
              $success = "Noticia creada con éxito.";

              self::showCreatePage($success);
              exit;
            } catch (Exception $e) {
              $error = "Error al guardar la noticia: " . $e->getMessage();
            }
          } else {
            $error = "Hubo un error al subir la imagen.";
          }
        }
      } else {
        $error = "Por favor, sube una imagen.";
      }
    }

    // Renderizar la vista con el resultado
    require_once './src/views/news/create.php';
  }

  // Mostrar la página de edición de noticias
  public function showEditPage($id, $error = '', $success = '')
  {
    $success = $success;
    $news = $this->newsModel->getById($id);
    if (!$news) {
      $error = "Noticia no encontrada.";
    }

    // Renderizar la vista de edición
    require_once './src/views/news/edit.php';
  }

  // Manejar la actualización de noticias
  public function update($id)
  {
    $error = '';
    $success = '';

    $titulo = trim($_POST['titulo']);
    $contenido = trim($_POST['contenido']);
    $autor = trim($_POST['autor']);
    $imagen = $_FILES['imagen']['name'];

    if ($imagen) {
      $target_dir = "./public/assets/img/";
      $target_file = $target_dir . basename($imagen);
      $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

      // Validar imagen
      $check = getimagesize($_FILES['imagen']['tmp_name']);
      if ($check === false) {
        $error = "El archivo no es una imagen.";
      } elseif (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
        $error = "Solo se permiten imágenes en formato JPG, JPEG, PNG y GIF.";
      } elseif ($_FILES['imagen']['size'] > 2 * 1024 * 1024) {
        $error = "El tamaño máximo permitido para las imágenes es 2 MB.";
      } else {
        // Subir imagen y actualizar en la base de datos
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $target_file)) {
          try {
            $imagen_path = '/public/assets/img/' . $imagen;
            $this->newsModel->update($id, $titulo, $contenido, $imagen_path, $autor);
            $success = "Noticia actualizada con éxito.";

            // Mostrar la página de edición con el mensaje de éxito
            self::showEditPage($id, '', $success);
            exit;
          } catch (Exception $e) {
            $error = "Error al actualizar la noticia: " . $e->getMessage();
          }
        } else {
          $error = "Hubo un error al subir la imagen.";
        }
      }
    } else {
      // Si no se sube una nueva imagen, mantenemos la imagen actual
      $imagen_path = $this->newsModel->getById($id)['imagen'];
      $this->newsModel->update($id, $titulo, $contenido, $imagen_path, $autor);
      $success = "Noticia actualizada con éxito.";

      self::showEditPage($id, '', $success);
      exit;
    }

    self::showEditPage($id, $error);
  }

  // Eliminar una noticia
  public function delete($id)
  {
    try {
      $this->newsModel->deleteById($id);
      $success = "Noticia eliminada con éxito.";
    } catch (Exception $e) {
      $error = "Error al eliminar la noticia: " . $e->getMessage();
    }

    $success = "Noticia eliminada con éxito.";
    self::showCreatePage($success);
  }
}
