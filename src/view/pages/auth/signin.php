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
  <link rel="stylesheet" href="../styles/styles.css" />
</head>

<body>
  <header>
    <?php include '../../components/header.php' ?>
  </header>



  <main>
    <div class="container text-center">

      <div class="row">
        <div class="col">
          <h1>REGISTRARSE</h1>
        </div>
      </div>

      <?php include '../../components/alerts.php' ?>

      <form action="../../../controller/handle_signin.php" method="post" id="formSigninCliente">
        <div class="row">
          <input type="text" name="nombre_usuario" id="nombre" placeholder="Ingrese su Nombre y Apellido" required />
        </div>
        <div class="row">
          <input type="email" name="email_usuario" id="mail" placeholder="Ingrese su Mail" required />
        </div>
        <div class="row">
          <input type="password" name="clave_usuario" id="pass" placeholder="Ingrese su Contraseña" required />
        </div>
        <div class="row">
          <input type="password" name="clave_usuario_conf" id="pass" placeholder="Ingrese su Contraseña Nuevamente" required />
        </div>
        <div class="row">
          <button class="btn btn-primary" type="submit" id="botonCrearCliente" name="botonCrearCliente">Crear cuenta</button>
        </div>
      </form>
      <div>¿Ya tienes cuenta? <a href="<?php echo app_path('src/view/pages/auth/login.php'); ?>">Iniciar sesión</a></div>

    </div>
    </div>
  </main>




  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous">
  </script>
</body>

</html>