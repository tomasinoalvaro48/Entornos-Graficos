<?php require_once __DIR__ . '/../../../controller/auth.php'; ?>

<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrarse</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
    crossorigin="anonymous" />
  <link rel="stylesheet" href="<?php echo app_path('src/view/styles/styles.css'); ?>" />
</head>

<body>
  <header>
    <?php include '../../components/header.php' ?>
  </header>

  <main class="c-page-main">
    <section class="c-card c-card--login" aria-label="Registro de dueño">
      <?php include '../../components/alerts.php' ?>

      <nav class="c-tabs" aria-label="Navegación autenticación">
        <a class="c-tab" href="<?php echo app_path('src/view/pages/auth/login.php'); ?>">Ingreso</a>
        <a class="c-tab" href="<?php echo app_path('src/view/pages/auth/signin.php'); ?>">Registro clientes</a>
        <a class="c-tab c-tab--active" href="<?php echo app_path('src/view/pages/auth/signin_dueno.php'); ?>">Registro dueño</a>
      </nav>

      <header class="c-hero">
        <h1 class="c-title">Registro de dueño</h1>
        <p class="c-subtitle">Solicitá una cuenta para tu negocio</p>
      </header>

      <form action="../../../controller/handle_signin.php" method="post" id="formSigninDueno" class="c-form">
        <div class="c-field">
          <input class="c-input" type="text" name="nombre_dueno" id="nombre_dueno" placeholder=" " autocomplete="name" required />
          <label class="c-label" for="nombre_dueno">Nombre y apellido</label>
        </div>

        <div class="c-field">
          <input class="c-input" type="email" name="email_dueno" id="mail_dueno" placeholder=" " autocomplete="email" required />
          <label class="c-label" for="mail_dueno">Correo</label>
        </div>

        <div class="c-field">
          <input class="c-input" type="password" name="clave_dueno" id="pass_dueno" placeholder=" " autocomplete="new-password" required />
          <label class="c-label" for="pass_dueno">Contraseña</label>
        </div>

        <div class="c-field">
          <input class="c-input" type="password" name="clave_dueno_conf" id="pass_dueno_conf" placeholder=" " autocomplete="new-password" required />
          <label class="c-label" for="pass_dueno_conf">Repetir contraseña</label>
        </div>

        <button class="c-btn-primary" type="submit" id="botonSolicitarDueno" name="botonSolicitarDueno">Enviar solicitud</button>
      </form>

      <p class="c-footnote">¿Ya tienes cuenta? <a href="<?php echo app_path('src/view/pages/auth/login.php'); ?>">Iniciar sesión</a></p>
    </section>
  </main>




  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous">
  </script>
</body>

</html>