<main>
  <div class="container text-center">
    <div class="row">
      <div class="col">
        <h1>Iniciar Sesion</h1>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <form action="config/login.php" method="post" id="formInicioSesion">
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
        <div>¿No tienes cuenta? <a href="index.php?page=signin">Registrarse</a></div>
      </div>
    </div>
  </div>
</main>
