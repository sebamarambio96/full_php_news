<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
  <a class="navbar-brand" href="<?= $_ENV['BASE_URL'] ?>/home">Ipp News</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?= $_ENV['BASE_URL'] ?>/home">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= $_ENV['BASE_URL'] ?>/news/create">Administrar Noticia</a>
      </li>
      <!-- Botón de cerrar sesión -->
      <li class="nav-item">
        <a class="nav-link" href="<?= $_ENV['BASE_URL'] ?>/logout">
          <i class="fas fa-sign-out-alt"></i> Cerrar sesión
        </a>
      </li>
    </ul>
  </div>
</nav>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
