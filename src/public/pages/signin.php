<title>Registrarse</title>
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