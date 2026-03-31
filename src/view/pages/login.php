<?php
require_once __DIR__ . "/../../controller/auth.php";

$error = getSessionError();
$success = getSessionSuccess();
clearSessionMessages();
?>

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
  <link rel="stylesheet" href="../styles/styles.css" />
</head>

<body>
  <header>
    <?php include '../components/header.php' ?>
  </header>

  <main>
    <div class="container text-center">
      <div class="row">
        <div class="col">
          <h1>Iniciar Sesion</h1>
        </div>
      </div>

      <!-- Mostrar mensaje de error si existe -->
      <?php
      if ($error) { ?>
        <div class="row mt-3">
          <div class="col">
            <div class="alert alert-danger" role="alert">
              <?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8');
              ?>
            </div>
          </div>
        </div>
      <?php } ?>

      <!-- Mostrar mensaje de éxito si existe -->
      <?php if ($success) { ?>
        <div class="row mt-3">
          <div class="col">
            <div class="alert alert-success" role="alert">
              <?php echo htmlspecialchars($success, ENT_QUOTES, 'UTF-8');
              unset($success); ?>
            </div>
          </div>
        </div>
      <?php } ?>

      <!-- Formulario de inicio de sesión -->
      <div class="row">
        <div class="col">
          <form action="../../controller/handle_login.php" method="post" id="formInicioSesion">
            <div class="row">
              <input type="email" name="mail" id="mail" placeholder="Ingrese Mail" required />
            </div>
            <div class="row">
              <input type="password" name="pass" id="pass" placeholder="Ingrese contraseña" required />
            </div>
            <div class="row">
              <div class="col">
                <input type="checkbox" name="rememberMe" id="rememberMe" />
                <label for="rememberMe">Recordarme</label>
              </div>
            </div>
            <button type="submit" class="btn btn-primary" id="botonIniciar" name="botonIniciar">Iniciar Sesion</button>
          </form>
        </div>
      </div>

      <div>
        <div>
          <a href="#"> ¿Has olvidado la contraseña? </a>
          <div>¿No tienes cuenta? <a href="../pages/signin.php">Registrarse</a></div>
        </div>
      </div>
    </div>

  </main>



  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous">
  </script>
</body>