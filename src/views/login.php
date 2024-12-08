<?php
require_once './src/views/partials/header.php';
?>

<body class="text-center">
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h2>Iniciar Sesión</h2>

        <?php if (!empty($registerSuccess)): ?>
          <div class="alert alert-success"><?= $registerSuccess ?></div>
        <?php endif; ?>

        <?php if (!empty($loginError)): ?>
          <div class="alert alert-danger"><?= $loginError ?></div>
        <?php endif; ?>

        <?php if (!empty($infoMessage)): ?>
          <div class="alert alert-info"><?= $infoMessage ?></div>
        <?php endif; ?>

        <form method="POST" action="<?= $_ENV['BASE_URL'] ?>/login">
          <input type="hidden" name="action" value="login">

          <div class="form-group mb-3">
            <label for="username">Nombre de Usuario o Correo Electrónico</label>
            <input type="text" id="username" name="username" class="form-control" placeholder="Nombre de Usuario o Correo Electrónico" required>
          </div>

          <div class="form-group mb-3">
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña" required>
          </div>

          <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
        </form>

        <p class="mt-3">
          ¿No tienes una cuenta? <a href="<?= $_ENV['BASE_URL'] ?>/register">Regístrate aquí</a>
        </p>
      </div>
    </div>
  </div>
</body>

<?php
require_once './src/views/partials/footer.php';
?>