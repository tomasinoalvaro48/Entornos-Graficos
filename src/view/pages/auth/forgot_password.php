<?php
require_once __DIR__ . '/../../../controller/auth.php';

$error = getSessionError();
clearSessionMessages();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Recuperar contraseña</title>

  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
    crossorigin="anonymous" />

  <link rel="stylesheet" href="../../styles/styles.css" />
</head>

<body>
  <div class="container text-center">
    <div class="row">
      <div class="col">
        <h1>Recuperar contraseña</h1>
      </div>
    </div>

    <div class="row">
      <div class="col">
        <?php if ($error) { ?>
          <div class="row mt-3">
            <div class="col">
              <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
              </div>
            </div>
          </div>
        <?php } ?>

        <form action="<?php echo app_path('src/controller/handle_forgot_password.php'); ?>" method="POST">
          <div>
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>

          <button type="submit" class="btn btn-primary" name="botonRecuperar">
            Enviar mail de recuperación
          </button>
        </form>

        <a href="<?php echo app_path('src/view/pages/auth/login.php'); ?>" class="btn btn-secondary">
          Volver al login
        </a>
      </div>
    </div>
  </div>

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous">
  </script>
</body>

</html>