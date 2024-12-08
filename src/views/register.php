<?php
require_once './src/views/partials/header.php';

// Mensaje de error al registrarse
if (isset($_SESSION['register_error'])) {
    $registerError = $_SESSION['register_error'];
    unset($_SESSION['register_error']);
} else {
    $registerError = '';
}

?>

<body class="text-center">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2>Registrarse</h2>
                <?php if (!empty($registerError)): ?>
                    <div class="alert alert-danger"><?= $registerError ?></div>
                <?php endif; ?>

                <?php if (!empty($registerSuccess)): ?>
                    <div class="alert alert-success"><?= $registerSuccess ?></div>
                <?php endif; ?>

                <form method="POST" action="<?= $_ENV['BASE_URL'] ?>/register">
                    <input type="hidden" name="action" value="register">
                    <div class="form-group mb-3">
                        <label for="reg_username">Nombre de Usuario</label>
                        <input type="text" id="reg_username" name="reg_username" class="form-control" placeholder="Nombre de Usuario" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="reg_nombre_completo">Nombre Completo</label>
                        <input type="text" id="reg_nombre_completo" name="reg_nombre_completo" class="form-control" placeholder="Nombre completo" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="reg_fecha_nacimiento">Fecha de nacimiento</label>
                        <input type="date" id="reg_fecha_nacimiento" name="reg_fecha_nacimiento" class="form-control" placeholder="Fecha de nacimiento" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="reg_email">Correo Electrónico</label>
                        <input type="email" id="reg_email" name="reg_email" class="form-control" placeholder="Correo Electrónico" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="reg_password">Contraseña</label>
                        <input type="password" id="reg_password" name="reg_password" class="form-control" placeholder="Contraseña" required>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Registrarse</button>
                </form>
                <p class="mt-3">
                    ¿Ya tienes una cuenta? <a href="<?= $_ENV['BASE_URL'] ?>/">Inicia sesión aquí</a>
                </p>
            </div>
        </div>
    </div>
</body>

<?php
require_once './src/views/partials/footer.php';
?>