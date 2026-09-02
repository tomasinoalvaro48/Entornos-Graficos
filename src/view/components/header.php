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
        <label for="c-header-search-input" class="visually-hidden" style="position: absolute; left: -9999px;">Buscar Locales o Promociones</label>
        <input
          id="c-header-search-input"
          class="form-control c-header-search-input"
          name="busqueda"
          type="search"
          placeholder="Buscar Locales o Promociones"
          aria-label="Buscar Locales o Promociones"
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
              <a class="nav-link" href="<?php echo app_path('src/view/pages/local/local_list.php'); ?>">Locales</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo app_path('src/view/pages/promocion/promocion_list.php'); ?>">Promociones</a>
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
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="<?php echo app_path('src/view/pages/local/local_list.php'); ?>">Ver locales</a></li>
                <li><a class="dropdown-item" href="<?php echo app_path('src/view/pages/local/create_local.php'); ?>">Crear local</a></li>
              </ul>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                Promociones
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="<?php echo app_path('src/view/pages/promocion/validar_promociones.php'); ?>">Ver y gestionar promociones</a></li>
                <li><a class="dropdown-item" href="<?php echo app_path('src/view/pages/uso_promocion/reporte_promociones.php'); ?>">Reporte de uso de promociones</a></li>
              </ul>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                Novedades
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="<?php echo app_path('src/view/pages/novedad/novedad_list.php'); ?>">Ver novedades</a></li>
                <li><a class="dropdown-item" href="<?php echo app_path('src/view/pages/novedad/novedad_create.php'); ?>">Crear novedad</a></li>
              </ul>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                Usuarios
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
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
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="<?php echo app_path('src/view/pages/local/local_list.php'); ?>">Ver locales</a></li>
              </ul>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                Promociones
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="<?php echo app_path('src/view/pages/promocion/promocion_list.php'); ?>">Buscar promociones</a></li>
                <li><a class="dropdown-item" href="<?php echo app_path('src/view/pages/uso_promocion/mis_usos_cliente.php'); ?>">Mis usos de promociones</a></li>
              </ul>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                Novedades
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="<?php echo app_path('src/view/pages/novedad/novedad_list.php'); ?>">Ver novedades</a></li>
              </ul>
            </li>


          <?php } else if ($tipo === TipoUsuario::DUENO->value) { ?>
            <!-- Dueños -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                Locales
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="<?php echo app_path('src/view/pages/local/local_list.php'); ?>">Ver mis locales</a></li>
              </ul>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                Promociones
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="<?php echo app_path('src/view/pages/promocion/promocion_list.php'); ?>">Ver mis promociones</a></li>
                <li><a class="dropdown-item" href="<?php echo app_path('src/view/pages/promocion/create_promocion.php'); ?>">Crear promoción</a></li>
                <li><a class="dropdown-item" href="<?php echo app_path('src/view/pages/uso_promocion/validar_uso_promocion.php'); ?>">Gestionar usos de promociones</a></li>
              </ul>
            </li>
          <?php } ?>

          <!-- Menú usuario / Opciones Adicionales -->
          <li class="nav-item dropdown">
            <?php if ($tipo) { ?>
              <?php
                $nombreUsuario = $usuario['nombre_usuario'] ?? 'Usuario';
                $emailUsuario = $usuario['email_usuario'] ?? '';
                $inicialUsuario = mb_strtoupper(mb_substr($nombreUsuario, 0, 1));
              ?>
              <a class="nav-link d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="c-user-avatar"><?php echo htmlspecialchars($inicialUsuario); ?></span>
              </a>
              <ul class="dropdown-menu dropdown-menu-end c-user-dropdown">
                <!-- Cabecera del perfil -->
                <li class="c-user-dropdown-header">
                  <span class="c-user-avatar c-user-avatar-lg"><?php echo htmlspecialchars($inicialUsuario); ?></span>
                  <div class="c-user-dropdown-info">
                    <span class="c-user-dropdown-name"><?php echo htmlspecialchars($nombreUsuario); ?></span>
                    <span class="c-user-dropdown-email"><?php echo htmlspecialchars($emailUsuario); ?></span>
                  </div>
                </li>

                <?php if ($tipo === TipoUsuario::CLIENTE->value) { ?>
                  <?php
                    // Consultar usos aceptados en tiempo real
                    require_once __DIR__ . "/../../data/UsoPromocionDAO.php";
                    $usoDAO = new UsoPromocionDAO();
                    $cantidadUsos = $usoDAO->countUsosAceptadosByCliente($usuario['id_usuario']);
                    $categoriaActual = $usuario['categoria_cliente'] ?? 'inicial';

                    // Calcular progreso hacia la siguiente categoría
                    if ($categoriaActual === 'premium') {
                      $categoriaSiguiente = null;
                      $progresoPorcentaje = 100;
                      $usosActuales = $cantidadUsos;
                      $usosNecesarios = $cantidadUsos;
                    } elseif ($categoriaActual === 'medium') {
                      $categoriaSiguiente = 'Premium';
                      $usosNecesarios = 6;
                      $usosActuales = $cantidadUsos;
                      $progresoPorcentaje = min(100, round(($cantidadUsos / $usosNecesarios) * 100));
                    } else {
                      $categoriaSiguiente = 'Medium';
                      $usosNecesarios = 3;
                      $usosActuales = $cantidadUsos;
                      $progresoPorcentaje = min(100, round(($cantidadUsos / $usosNecesarios) * 100));
                    }
                  ?>
                  <!-- Barra de progreso de categoría -->
                  <li class="c-user-progress">
                    <div class="c-user-progress-label">
                      <?php if ($categoriaSiguiente) { ?>
                        <span><?php echo ucfirst($categoriaActual); ?> → <?php echo $categoriaSiguiente; ?></span>
                        <span><?php echo $usosActuales; ?> / <?php echo $usosNecesarios; ?> promos</span>
                      <?php } else { ?>
                        <span>Premium</span>
                        <span>¡Máximo nivel!</span>
                      <?php } ?>
                    </div>
                    <div class="c-user-progress-track">
                      <div class="c-user-progress-fill" style="width: <?php echo $progresoPorcentaje; ?>%"></div>
                    </div>
                    <?php if ($categoriaSiguiente) { ?>
                      <div class="c-user-progress-hint">
                        Te faltan <?php echo ($usosNecesarios - $usosActuales); ?> promo<?php echo ($usosNecesarios - $usosActuales) !== 1 ? 's' : ''; ?> para subir a <?php echo $categoriaSiguiente; ?>
                      </div>
                    <?php } ?>
                  </li>
                <?php } ?>

                <li><hr class="dropdown-divider c-user-dropdown-divider"></li>
                <li>
                  <a class="dropdown-item c-user-dropdown-item" href="<?php echo app_path('src/view/pages/mas_sobre_nosotros.php'); ?>">
                    <i class="bi bi-info-circle-fill c-user-dropdown-item-icon"></i>
                    Más sobre nosotros
                  </a>
                </li>
                <li>
                  <a class="dropdown-item c-user-dropdown-item" href="<?php echo app_path('src/view/pages/auth/change_password.php'); ?>">
                    <i class="bi bi-key-fill c-user-dropdown-item-icon"></i>
                    Modificar contraseña
                  </a>
                </li>
                <li><hr class="dropdown-divider c-user-dropdown-divider"></li>
                <li>
                  <a class="dropdown-item c-user-dropdown-item c-user-dropdown-item--danger" href="<?php echo app_path('src/controller/handle_logout.php'); ?>">
                    <i class="bi bi-box-arrow-right c-user-dropdown-item-icon"></i>
                    Cerrar Sesión
                  </a>
                </li>
              </ul>
            <?php } else { ?>
              <a class="nav-link d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-list fs-4"></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-end c-user-dropdown">
                <li>
                  <a class="dropdown-item c-user-dropdown-item" href="<?php echo app_path('src/view/pages/mas_sobre_nosotros.php'); ?>">
                    <i class="bi bi-info-circle-fill c-user-dropdown-item-icon"></i>
                    Más sobre nosotros
                  </a>
                </li>
              </ul>
            <?php } ?>
          </li>
        </ul>
      </div>
    <?php } ?>
  </div>
</nav>