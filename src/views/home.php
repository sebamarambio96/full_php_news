<?php require_once './src/views/partials/header.php'; ?>

<body class="bg-light">
  <?php require_once './src/views/partials/nav.php'; ?>

  <div class="container mt-5 pt-5">
    <div class="row">
      <div class="col-md-12">
        <div class="jumbotron text-center bg-info text-white">
          <h1 class="display-4"><?= htmlspecialchars($titulo) ?></h1>
          <p class="lead"><?= htmlspecialchars($descripcion) ?></p>
        </div>

        <div class="mt-4">
          <h2 class="text-center">Noticias Recientes</h2>

          <?php if (count($news) > 0): ?>
            <?php foreach ($news as $noticia): ?>
              <div class="card mb-4">
                <div class="card-body">
                  <?php if ($noticia['imagen']): ?>
                    <img src="<?= $_ENV['BASE_URL'] ?><?= htmlspecialchars($noticia['imagen']) ?>" class="img-fluid mb-3 rounded" width="300px" alt="Imagen de la noticia">
                  <?php endif; ?>
                  <h5 class="card-title"><?= htmlspecialchars($noticia['titulo']) ?></h5>
                  <p class="card-text"><?= htmlspecialchars(substr($noticia['contenido'], 0, 150)) ?>...</p>
                  <a href="<?= $_ENV['BASE_URL'] ?>/news/<?= $noticia['id'] ?>" class="btn btn-primary">Leer más</a>
                </div>
                <div class="card-footer text-muted">
                  <small>Publicado el <?= date('d/m/Y', strtotime($noticia['fecha_publicacion'])) ?> por <?= htmlspecialchars($noticia['autor']) ?></small>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <p class="text-center">No hay noticias disponibles en este momento.</p>
          <?php endif; ?>
        </div>

      </div>
    </div>
  </div>

</body>

<?php require_once './src/views/partials/footer.php'; ?>