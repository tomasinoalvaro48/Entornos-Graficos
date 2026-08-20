<?php
require_once __DIR__ . '/../../../controller/auth.php';
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../../styles/styles.css" />
</head>

<body>
  <main class="c-page-main align-items-center">
    <section class="c-card">
      <?php include '../../components/alerts.php'; ?>

      <header class="c-hero">
        <h1 class="c-title">Recuperar contraseña</h1>
        <p class="c-subtitle">Te vamos a enviar un mail para restablecerla</p>
      </header>

      <form action="<?php echo app_path('src/controller/handle_forgot_password.php'); ?>" method="POST" class="c-form-layout">
        <div class="c-form-field">
          <input type="email" name="email" class="c-form-input" placeholder=" " required>
          <label class="c-form-label">Correo electrónico</label>
        </div>

        <button type="submit" class="c-btn-primary">
          Enviar mail de recuperación
        </button>

        <a href="<?php echo app_path('src/view/pages/auth/login.php'); ?>" class="c-btn-secondary-ghost">
          Volver al login
        </a>
      </form>
    </section>
  </main>

  <footer>
    <?php include_once __DIR__ . '/../../components/footer.php'; ?>
  </footer>

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous">
  </script>
</body>

</html>