<?php require_once './src/views/partials/header.php'; ?>

<body class="bg-light">
  <?php require_once './src/views/partials/nav.php'; ?>
  <div class="container mt-5 pt-5">
    <div class="row">
      <div class="col-md-12">
        <div class="jumbotron text-center bg-info text-white">
          <h1 class="display-4"><?= htmlspecialchars($news['titulo']) ?></h1>
          <p class="lead">Publicado el <?= date('d/m/Y', strtotime($news['fecha_publicacion'])) ?> por <?= htmlspecialchars($news['autor']) ?></p>
          <?php if ($news['imagen']): ?>
            <img src="<?= $_ENV['BASE_URL'] ?><?= htmlspecialchars($news['imagen']) ?>" class="img-fluid mb-3" alt="Imagen de la noticia">
          <?php endif; ?>
        </div>

        <div class="news-content">
          <p><?= nl2br(htmlspecialchars($news['contenido'])) ?></p>
        </div>
      </div>
    </div>
  </div>
</body>

<?php require_once './src/views/partials/footer.php'; ?>