<?php require_once __DIR__ . '/../../../controller/auth.php'; ?>

<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión</title>
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
    <section class="c-card c-card--login" aria-label="Inicio de sesión">
      <?php include '../../components/alerts.php' ?>

      <nav class="c-tabs" aria-label="Navegación autenticación">
        <a class="c-tab c-tab--active" href="<?php echo app_path('src/view/pages/auth/login.php'); ?>">Ingreso</a>
        <a class="c-tab" href="<?php echo app_path('src/view/pages/auth/signin.php'); ?>">Registro clientes</a>
        <a class="c-tab" href="<?php echo app_path('src/view/pages/auth/signin_dueno.php'); ?>">Registro dueño</a>
      </nav>

      <header class="c-hero">
        <h1 class="c-title">Te extrañamos</h1>
        <p class="c-subtitle">Ingresá para continuar</p>
      </header>

      <form action="../../../controller/handle_login.php" method="post" id="formLogin" class="c-form">
        <div class="c-field">
          <input class="c-input" type="email" name="mail" id="mail" placeholder=" " autocomplete="email" required />
          <label class="c-label" for="mail">Correo</label>
        </div>

        <div class="c-field">
          <input class="c-input" type="password" name="pass" id="pass" placeholder=" " autocomplete="current-password" required />
          <label class="c-label" for="pass">Contraseña</label>
        </div>

        <div class="c-row-between c-meta-row">
          <label class="c-check" for="rememberMe">
            <input class="c-check-input" type="checkbox" name="rememberMe" id="rememberMe" />
            <span>Recordarme</span>
          </label>
          <a class="c-link-muted" href="#">¿Has olvidado la contraseña?</a>
        </div>

        <button type="submit" class="c-btn-primary" id="botonIniciar" name="botonIniciar">Entrar</button>

        <p class="c-footnote">¿No tienes cuenta? <a href="<?php echo app_path('src/view/pages/auth/signin.php'); ?>">Registrarse</a></p>
      </form>
    </section>
  </main>



  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous">
  </script>
</body>