<?php require_once './src/views/partials/header.php'; ?>

<body class="bg-light">
  <?php require_once './src/views/partials/nav.php'; ?>

  <div class="container mt-5 pt-5">
    <h1>Crear Nueva Noticia</h1>

    <?php if (!empty($error)): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
      <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data" action="<?= $_ENV['BASE_URL'] ?>/news/create">
      <div class="form-group">
        <label for="titulo">Título</label>
        <input type="text" class="form-control" id="titulo" name="titulo" required>
      </div>
      <div class="form-group">
        <label for="contenido">Contenido</label>
        <textarea class="form-control" id="contenido" name="contenido" rows="5" required></textarea>
      </div>
      <div class="form-group">
        <label for="imagen">Imagen</label>
        <input type="file" class="form-control" id="imagen" name="imagen" required>
      </div>
      <div class="form-group">
        <label for="autor">Autor</label>
        <input type="text" class="form-control" id="autor" name="autor" required>
      </div>
      <button type="submit" class="btn btn-success">Crear Noticia</button>
    </form>

    <div class="container mt-5 pt-5">
      <h2 class="mt-5">Noticias Existentes</h2>
      <div class="row">
        <?php if (empty($news)): ?>
          <div class="col-12">
            <div class="alert alert-warning">No hay noticias disponibles.</div>
          </div>
        <?php else: ?>
          <?php foreach ($news as $data): ?>
            <div class="col-md-4 mb-4">
              <div class="card">
                <img src="<?= $_ENV['BASE_URL'] ?><?= htmlspecialchars($data['imagen']) ?>" width="300px" height="300px" class="card-img-top" alt="<?= htmlspecialchars($data['titulo']) ?>">
                <div class="card-body">
                  <h5 class="card-title"><?= htmlspecialchars($data['titulo']) ?></h5>
                  <p class="card-text"><?= htmlspecialchars(substr($data['contenido'], 0, 100)) ?>...</p>
                  <a href="<?= $_ENV['BASE_URL'] ?>/news/<?= $data['id'] ?>" class="btn btn-primary btn-block">Ver Detalle</a>
                  <a href="<?= $_ENV['BASE_URL'] ?>/news/edit/<?= $data['id'] ?>" class="btn btn-secondary btn-block">Editar</a>
                  <!-- Formulario para eliminar una noticia -->
                  <form action="<?= $_ENV['BASE_URL'] ?>/news/delete/<?= $data['id'] ?>" method="POST" style="display:inline;">
                    <button type="submit" class="btn btn-danger btn-block mt-2" onclick="return confirm('¿Seguro que deseas eliminar esta noticia?')">Eliminar</button>
                  </form>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</body>

<?php require_once './src/views/partials/footer.php'; ?>