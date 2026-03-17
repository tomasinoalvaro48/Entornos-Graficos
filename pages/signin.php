<title>Registrarse</title>
<main>
  <div class="d-flex flex-row justify-content-center">
    <h1>REGISTRARSE</h1>
  </div>

  <div class="d-flex flex-row justify-content-center">
    <div class="d-flex flex-column align-items-center">
      <form action="config/signin.php" method="post" id="formInicioSesion">
        <input type="text" name="nombre_usuario" id="usuario" placeholder="Ingrese usuario" required />
        <input type="email" name="email_usuario" id="mail" placeholder="Ingrese Mail" required />
        <input type="password" name="clave_usuario" id="pass" placeholder="Ingrese contraseña" required />
        <button class="btn btn-primary" type="submit" id="botonCrear" name="botonCrear">Crear cuenta</button>
      </form>
    </div>
  </div>
</main>