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

  <main class="c-page-main align-items-center">
    <section class="c-card" aria-label="Registro de usuario">
      <?php include '../../components/alerts.php' ?>

      <nav class="c-tabs" aria-label="Navegación autenticación">
        <a class="c-tab" href="<?php echo app_path('src/view/pages/auth/login.php'); ?>">Ingreso</a>
        <a class="c-tab c-tab--active" href="<?php echo app_path('src/view/pages/auth/signin.php'); ?>">Registro clientes</a>
        <a class="c-tab" href="<?php echo app_path('src/view/pages/auth/signin_dueno.php'); ?>">Registro dueño</a>
      </nav>

      <header class="c-hero">
        <h1 class="c-title">Creá tu cuenta</h1>
        <p class="c-subtitle">Completá los datos para registrarte</p>
      </header>

      <form action="../../../controller/handle_signin.php" method="post" id="formSigninCliente" class="c-form-layout">
        <div class="c-form-field">
          <input class="c-form-input" type="text" name="nombre_usuario" id="nombre" placeholder=" " autocomplete="name" required />
          <label class="c-form-label" for="nombre">Nombre y apellido</label>
        </div>

        <div class="c-form-field">
          <input class="c-form-input" type="email" name="email_usuario" id="mail" placeholder=" " autocomplete="email" required />
          <label class="c-form-label" for="mail">Correo</label>
        </div>

        <div class="c-form-field" style="position: relative;">
          <input class="c-form-input" type="password" name="clave_usuario" id="pass" placeholder=" " autocomplete="new-password" required style="padding-right: 2.5rem;" />
          <label class="c-form-label" for="pass">Contraseña</label>
          <button type="button" onclick="togglePasswordVisibility('pass', this)" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #6c757d; padding: 0;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
              <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
              <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
            </svg>
          </button>
        </div>

        <div class="c-form-field" style="position: relative;">
          <input class="c-form-input" type="password" name="clave_usuario_conf" id="pass_conf" placeholder=" " autocomplete="new-password" required style="padding-right: 2.5rem;" />
          <label class="c-form-label" for="pass_conf">Repetir contraseña</label>
          <button type="button" onclick="togglePasswordVisibility('pass_conf', this)" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #6c757d; padding: 0;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
              <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
              <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
            </svg>
          </button>
        </div>

        <button class="c-btn-primary" type="submit" id="botonCrearCliente" name="botonCrearCliente">Crear cuenta</button>
      </form>

      <p class="c-form-footnote">¿Ya tienes cuenta? <a href="<?php echo app_path('src/view/pages/auth/login.php'); ?>">Iniciar sesión</a></p>
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

<script>
  function togglePasswordVisibility(inputId, button) {
    const input = document.getElementById(inputId);
    if (input.type === 'password') {
      input.type = 'text';
      button.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/><path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/><path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/></svg>';
    } else {
      input.type = 'password';
      button.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/><path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/></svg>';
    }
  }

  const passInputId = 'pass';
  const passConfInputId = 'pass_conf';
  <?php include_once __DIR__ . "/password_validator.js"; ?>
</script>
</body>

</html>