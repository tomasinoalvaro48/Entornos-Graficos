<?php
require_once __DIR__ . "/../../controller/auth.php";
$tipo = getTipoUsuario();
$serverUri = $_SERVER["REQUEST_URI"];
$excludePaths = [ // Rutas donde solo se muestra el logo en el header
  app_path('src/view/pages/auth/login.php'),
  app_path('src/view/pages/auth/signin.php'),
  app_path('src/view/pages/auth/signin_dueno.php')
];
?>

<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo app_path(); ?>">LOGO</a>

    <!-- ---------------------- USUARIO NO LOGUEADO ---------------------- -->
    <?php if (!$tipo && in_array($serverUri, $excludePaths) === false) { ?>
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
            <a class="nav-link" href="<?php echo app_path('src/view/pages/promocion/promocion_list.php'); ?>">Promociones</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo app_path('src/view/pages/local/local_list.php'); ?>">Locales</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo app_path('src/view/pages/auth/login.php'); ?>">Iniciar sesion</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo app_path('src/view/pages/auth/signin.php'); ?>">Registrarse</a>
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
              <a class="nav-link" href="<?php echo app_path(); ?>">Inicio ADMIN</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo app_path('src/view/pages/local/local_list.php'); ?>">Locales</a>
            </li>
          </ul>
        </div>


        <!-- ---------------------- CLIENTE ---------------------- -->
      <?php } else if ($tipo === "cliente") { ?>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="<?php echo app_path(); ?>">Inicio CLIENTE</a>
            </li>
          </ul>
        </div>


        <!-- ---------------------- DUEÑO DE LOCAL ---------------------- -->
      <?php } else if ($tipo === "dueno") { ?>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="<?php echo app_path(); ?>">Inicio DUEÑO</a>
            </li>
          </ul>
        </div>
      <?php } ?>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo app_path('src/controller/handle_logout.php'); ?>">Cerrar Sesión</a>
          </li>
        </ul>
      </div>

    <?php } ?>
  </div>
</nav>