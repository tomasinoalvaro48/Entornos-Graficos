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

<nav class="navbar navbar-expand-lg navbar-dark sticky-top c-header-navbar" style="z-index: 1030;">
  <div class="container-fluid c-header-shell">
    <a class="navbar-brand c-header-brand" href="<?php echo app_path(); ?>">
      <img src="<?php echo app_path('src/img/logoSoloImagen.png'); ?>" alt="Logo Rivendell" class="c-header-brand-icon" />
      <span class="c-header-brand-text">
        <span class="c-header-brand-title">Rivendell</span>
        <span class="c-header-brand-subtitle">Plaza</span>
      </span>
    </a>

    <?php if (!$tipo && in_array($serverUri, $excludePaths) === false) { ?>
      <form class="d-flex c-header-search" role="search">
        <input class="form-control c-header-search-input" type="search" placeholder="Buscar Locales o Promociones" aria-label="Search" />
        <button class="btn c-header-search-btn" type="submit">Buscar</button>
      </form>
    <?php } ?>

    <?php if (in_array($serverUri, $excludePaths) === false) { ?>
      <button
        class="navbar-toggler c-header-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#cHeaderNav"
        aria-controls="cHeaderNav"
        aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse c-header-collapse" id="cHeaderNav">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 c-header-menu">
          <?php if (!$tipo) { ?>
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
          <?php } else if ($tipo === "admin") { ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo app_path(); ?>">Inicio ADMIN</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo app_path('src/view/pages/local/local_list.php'); ?>">Locales</a>
            </li>
          <?php } else if ($tipo === "cliente") { ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo app_path(); ?>">Inicio CLIENTE</a>
            </li>
          <?php } else if ($tipo === "dueno") { ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo app_path(); ?>">Inicio DUEÑO</a>
            </li>
          <?php } ?>

          <?php if ($tipo) { ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo app_path('src/controller/handle_logout.php'); ?>">Cerrar Sesión</a>
            </li>
          <?php } ?>
        </ul>
      </div>
    <?php } ?>
  </div>
</nav>