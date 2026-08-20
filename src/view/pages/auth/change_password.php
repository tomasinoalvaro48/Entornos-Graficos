<?php
require_once __DIR__ . '/../../../controller/auth.php';
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../../styles/styles.css" />
</head>

<body>
  <header>
    <?php include '../../components/header.php' ?>
  </header>

  <main class="c-page-main align-items-center">
    <section class="c-card">
      <?php include '../../components/alerts.php'; ?>

      <header class="c-hero">
        <h1 class="c-title">Cambiar contraseña</h1>
      </header>

      <form action="<?php echo app_path('src/controller/handle_change_password.php'); ?>" method="POST" class="c-form-layout">
        <div class="c-form-field">
          <input type="password" name="pass_actual" class="c-form-input" placeholder=" " required>
          <label class="c-form-label">Contraseña actual</label>
        </div>

        <div class="c-form-field">
          <input type="password" name="pass_nueva" class="c-form-input" placeholder=" " required>
          <label class="c-form-label">Nueva contraseña</label>
        </div>

        <div class="c-form-field">
          <input type="password" name="pass_repetir" class="c-form-input" placeholder=" " required>
          <label class="c-form-label">Repetir contraseña</label>
        </div>

        <button type="submit" class="c-btn-primary">
          Cambiar contraseña
        </button>

        <a href="<?php echo app_path('index.php'); ?>" class="c-btn-secondary-ghost">
          Volver al menú
        </a>
      </form>
    </section>
  </main>

  <footer>
    <?php include_once __DIR__ . '/../../components/footer.php'; ?>
  </footer>

</body>

</html>