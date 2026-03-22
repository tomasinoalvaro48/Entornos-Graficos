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
  <link rel="stylesheet" href="src/public/styles/styles.css" />
</head>

<body>
  <header>
    <?php include '../components/header.php' ?>
  </header>



  <main>
    <div class="container text-center">
      <div class="d-flex flex-row justify-content-center">
        <h1>REGISTRARSE</h1>
      </div>
      <form action="src/config/handle_signin_cliente.php" method="post" id="formInicioSesion">
        <div class="row">
          <input type="text" name="nombre_usuario" id="nombre" placeholder="Ingrese su Nombre" required />
        </div>
        <div class="row">
          <input type="email" name="email_usuario" id="mail" placeholder="Ingrese su Mail" required />
        </div>
        <div class="row">
          <input type="password" name="clave_usuario" id="pass" placeholder="Ingrese su Contraseña" required />
        </div>
        <div class="row">
          <button class="btn btn-primary" type="submit" id="botonCrear" name="botonCrear">Crear cuenta</button>
      </form>
    </div>
  </main>




  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous">
  </script>
</body>

</html>