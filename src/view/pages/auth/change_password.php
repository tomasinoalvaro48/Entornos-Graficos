<?php
require_once __DIR__ . '/../../../controller/auth.php';

$error = getSessionError();
$success = getSessionSuccess();
clearSessionMessages();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Cambiar contraseña</title>

  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
    crossorigin="anonymous" />

  <link rel="stylesheet" href="../../styles/styles.css" />
</head>

<body>
  <div class="container text-center">
    <h1>Cambiar contraseña</h1>

    <?php if ($error) { ?>
      <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php } ?>

    <?php if ($success) { ?>
      <div class="alert alert-success"><?php echo $success; ?></div>
    <?php } ?>

    <form action="<?php echo app_path('src/controller/handle_change_password.php'); ?>" method="POST">
      <div>
        <label>Contraseña actual</label>
        <input type="password" name="pass_actual" class="form-control" required>
      </div>

      <div>
        <label>Nueva contraseña</label>
        <input type="password" name="pass_nueva" class="form-control" required>
      </div>

      <div>
        <label>Repetir nueva contraseña</label>
        <input type="password" name="pass_repetir" class="form-control" required>
      </div>

      <button type="submit" class="btn btn-primary mt-3">
        Cambiar contraseña
      </button>
    </form>

    <a href="<?php echo app_path('index.php'); ?>" class="btn btn-secondary mt-2">
      Volver al menú
    </a>
  </div>
</body>
</html>