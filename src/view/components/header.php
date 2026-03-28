<?php
require_once __DIR__ . "/../../controller/auth.php";
$tipo = getTipoUsuario();
$serverUri = $_SERVER["REQUEST_URI"];
?>

<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">LOGO</a>
    <div>
      Bienvenido <?php echo $tipo ?? 'No hay tipo'; ?>
    </div>


    <!-- ---------------------- USUARIO NO LOGUEADO ---------------------- -->
    <?php
    if (
      !$tipo
      && $serverUri !== "/src/view/pages/login.php"
      && $serverUri !== "/src/view/pages/signin.php"
    ) {
    ?>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Buscar Locales o Promociones" aria-label="Search" />
        <button class="btn btn-outline-success" type="submit">Buscar</button>
      </form>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="/src/view/pages/promocion/promocion_list.php">Promociones</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/src/view/pages/local/local_list.php">Locales</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/src/view/pages/login.php">Iniciar sesion</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/src/view/pages/signin.php">Registrarse</a>
          </li>
        </ul>
      </div>


      <!-- ---------------------- ADMIN ---------------------- -->
      <?php
    } else if ($tipo) {
      if ($tipo === "admin") {
      ?>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="/">Inicio ADMIN</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/src/view/pages/local/local_list.php">Locales</a>
            </li>
          </ul>
        </div>


        <!-- ---------------------- CLIENTE ---------------------- -->
      <?php
      } else if ($tipo === "cliente") {
      ?>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="/">Inicio CLIENTE</a>
            </li>
          </ul>
        </div>


        <!-- ---------------------- DUEÑO DE LOCAL ---------------------- -->
      <?php
      } else if ($tipo === "dueno") {
      ?>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="/">Inicio DUEÑO</a>
            </li>
          </ul>
        </div>
      <?php
      }
      ?>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="/src/controller/handle_logout.php">Cerrar Sesión</a>
          </li>
        </ul>
      </div>
    <?php
    }
    ?>
  </div>
</nav>