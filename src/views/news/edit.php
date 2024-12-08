<?php require_once './src/views/partials/header.php'; ?>

<body class="bg-light">
  <?php require_once './src/views/partials/nav.php'; ?>

  <div class="container mt-5 pt-5">
    <div class="row">
      <div class="col-md-12">
        <h1 class="mb-4">Editar Noticia</h1>

        <?php if ($error): ?>
          <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
          <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <form method="POST" action="<?= $_ENV['BASE_URL'] ?>/news/edit/<?= htmlspecialchars($news['id']) ?>" enctype="multipart/form-data">
          <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="<?= htmlspecialchars($news['titulo']) ?>" required>
          </div>

          <div class="form-group">
            <label for="contenido">Contenido</label>
            <textarea class="form-control" id="contenido" name="contenido" rows="6" required><?= htmlspecialchars($news['contenido']) ?></textarea>
          </div>

          <div class="form-group">
            <label for="imagen">Imagen (opcional)</label>
            <input type="file" class="form-control-file" id="imagen" name="imagen">
            <br>
            <img src="<?= $_ENV['BASE_URL'] ?><?= htmlspecialchars($news['imagen']) ?>" alt="Imagen actual" width="100" />
          </div>

          <div class="form-group">
            <label for="autor">Autor</label>
            <input type="text" class="form-control" id="autor" name="autor" value="<?= htmlspecialchars($news['autor']) ?>" required>
          </div>

          <button type="submit" class="btn btn-success btn-block">Actualizar Noticia</button>
        </form>
      </div>
    </div>
  </div>

</body>

<?php require_once './src/views/partials/footer.php'; ?>