<?php

require_once __DIR__ . "/../../controller/auth.php";
require_once __DIR__ . "/../../enums.php";
require_once __DIR__ . "/notifications_dropdown.php";

$tipo = getTipoUsuario();
$usuario = getUsuarioLogueado();

$serverUri = $_SERVER["REQUEST_URI"];
$excludePaths = [ // Rutas donde solo se muestra el logo en el header
  app_path('src/view/pages/auth/login.php'),
  app_path('src/view/pages/auth/signin.php'),
  app_path('src/view/pages/auth/signin_dueno.php')
];
?>

<nav class="navbar navbar-expand-xl navbar-dark sticky-top c-header-navbar" style="z-index: 1030;">
  <div class="container-fluid c-header-shell">
    <!-- Logo y marca -->
    <a class="navbar-brand c-header-brand" href="<?php echo app_path(); ?>">
      <img src="<?php echo app_path('src/img/logoSoloImagen.png'); ?>" alt="Logo Rivendell" class="c-header-brand-icon" />
      <span class="c-header-brand-text">
        <span class="c-header-brand-title">Rivendell</span>
        <span class="c-header-brand-subtitle">Plaza</span>
      </span>
    </a>

    <?php if ($tipo) { ?>
      <!-- Notificaciones -->
      <?php renderHeaderNotifications($tipo); ?>
    <?php } ?>

    <!-- Menú de navegación -->
    <?php if (!in_array($serverUri, $excludePaths)) { ?>
      <!-- Buscador -->
      <form class="d-flex c-header-search" role="search" method="GET" action="<?php echo app_path('src/view/pages/locales_promociones_list.php'); ?>">
        <input
          class="form-control c-header-search-input"
          name="busqueda"
          type="search"
          placeholder="Buscar Locales o Promociones"
          aria-label="Search"
          required />
        <button class="btn c-header-search-btn" type="submit">Buscar</button>
      </form>

      <!-- Botón para colapsar el menú en pantallas pequeñas -->
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

      <!-- Opciones -->
      <div class="collapse navbar-collapse c-header-collapse" id="cHeaderNav">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 c-header-menu">
          <?php if (!$tipo) { ?>
            <!-- Usuarios no autenticados -->
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
          <?php } else if ($tipo === TipoUsuario::ADMIN->value) { ?>
            <!-- Administrador -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                Locales
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?php echo app_path('src/view/pages/local/local_list.php'); ?>">Ver locales</a></li>
                <li><a class="dropdown-item" href="<?php echo app_path('src/view/pages/local/create_local.php'); ?>">Crear local</a></li>
              </ul>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                Promociones
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?php echo app_path('src/view/pages/promocion/validar_promociones.php'); ?>">Ver y gestionar promociones</a></li>
                <li><a class="dropdown-item" href="<?php echo app_path('src/view/pages/uso_promocion/reporte_promociones.php'); ?>">Reporte de uso de promociones</a></li>
              </ul>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                Novedades
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?php echo app_path('src/view/pages/novedad/novedad_list.php'); ?>">Ver novedades</a></li>
                <li><a class="dropdown-item" href="<?php echo app_path('src/view/pages/novedad/novedad_create.php'); ?>">Crear novedad</a></li>
              </ul>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                Usuarios
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?php echo app_path('src/view/pages/usuario/validar_cuentas_dueno.php?estado=pendiente'); ?>">Administrar cuentas de dueños</a></li>
                <li><a class="dropdown-item" href="<?php echo app_path('src/view/pages/usuario/validar_cuentas_dueno.php'); ?>">Ver cuentas de dueños</a></li>
              </ul>
            </li>

          <?php } else if ($tipo === TipoUsuario::CLIENTE->value) { ?>
            <!-- Clientes -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                Locales
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?php echo app_path('src/view/pages/local/local_list.php'); ?>">Ver locales</a></li>
              </ul>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                Promociones
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?php echo app_path('src/view/pages/promocion/promocion_list.php'); ?>">Buscar promociones</a></li>
                <li><a class="dropdown-item" href="<?php echo app_path('src/view/pages/uso_promocion/mis_usos_cliente.php'); ?>">Mis usos de promociones</a></li>
              </ul>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                Novedades
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?php echo app_path('src/view/pages/novedad/novedad_list.php'); ?>">Ver novedades</a></li>
              </ul>
            </li>

            <li class="nav-item ">
              <span class="c-list-card-category">Categoría: <?php echo strtoupper($usuario['categoria_cliente']); ?></span>
            </li>

          <?php } else if ($tipo === TipoUsuario::DUENO->value) { ?>
            <!-- Dueños -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                Locales
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?php echo app_path('src/view/pages/local/local_list.php'); ?>">Ver mis locales</a></li>
              </ul>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                Promociones
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?php echo app_path('src/view/pages/promocion/promocion_list.php'); ?>">Ver mis promociones</a></li>
                <li><a class="dropdown-item" href="<?php echo app_path('src/view/pages/promocion/create_promocion.php'); ?>">Crear promoción</a></li>
                <li><a class="dropdown-item" href="<?php echo app_path('src/view/pages/uso_promocion/validar_uso_promocion.php'); ?>">Gestionar usos de promociones</a></li>
              </ul>
            </li>
          <?php } ?>


          <!-- Opciones comunes para usuarios autenticados -->
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