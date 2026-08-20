<div class="container">

  <!-- Texto de bienvenida -->
  <div class="row m-lg-5 m-3 text-center justify-content-center">
    <div class="col">
        <h2 class="c-menu-title">ADMINISTRACIÓN</h2>
    </div>
  </div>

  <!-- Grilla de locales -->
  <div class="row mb-2 align-items-stretch">
    <div class="col-md-6 col-lg-6 col-12 mb-2">
      <div class="c-menu-card d-flex flex-column justify-content-center align-items-center">
        <i class="bi bi-shop c-menu-icon-orange"></i>
        <h3 class="c-menu-card-title">LOCALES</h3>
        <p class="c-menu-card-text text-center">Crear, editar y eliminar locales del sistema.</p>
        <a href="<?php echo app_path('src/view/pages/local/local_list.php'); ?>" class="c-btn-primary">Gestionar Locales</a>
      </div>
    </div>

  <!-- Grilla de promociones con imagen -->
    <div class="col-md-6 col-lg-6 col-12">
      <div class="c-menu-card d-flex flex-column justify-content-center align-items-center">
        <i class="bi bi-tag c-menu-icon-orange"></i>
        <h3 class="c-menu-card-title">PROMOCIONES</h3>
        <p class="c-menu-card-text text-center">Aprobar y denegar promociones de dueños.</p>
        <a href="<?php echo app_path('src/view/pages/promocion/validar_promociones.php'); ?>" class="c-btn-primary">Gestionar Promociones</a>
      </div>
    </div>
  </div>

  <!-- Otras funcionalidades -->
  <div class="row mb-5">
    <div class="col-md-6 col-lg-4 col-12 mb-2">
      <div class="c-menu-card text-center">
        <i class="bi bi-newspaper c-menu-icon-orange"></i>
        <h3 class="c-menu-card-title">NOVEDADES</h3>
        <p class="c-menu-card-text">Gestionar novedades para clientes.</p>
        <a href="<?php echo app_path('src/view/pages/novedad/novedad_list.php'); ?>" class="c-btn-primary">Administrar Novedades</a>
      </div>
    </div>

    <div class="col-md-6 col-lg-4 col-12 mb-2">
      <div class="c-menu-card text-center">
        <i class="bi bi-person-check c-menu-icon-orange"></i>
        <h3 class="c-menu-card-title">DUEÑOS</h3>
        <p class="c-menu-card-text">Gestionar cuentas de dueños.</p>
        <a href="<?php echo app_path('src/view/pages/usuario/validar_cuentas_dueno.php'); ?>" class="c-btn-primary">Administrar Dueños</a>
      </div>
    </div>

    <div class="col-md-12 col-lg-4 col-12">
      <div class="c-menu-card text-center">
        <i class="bi bi-bar-chart c-menu-icon-orange"></i>
        <h3 class="c-menu-card-title">REPORTE DE PROMOCIONES</h3>
        <p class="c-menu-card-text">Ver todas las promociones y sus usos.</p>
        <a href="<?php echo app_path('src/view/pages/uso_promocion/reporte_promociones.php'); ?>" class="c-btn-primary">Ver Reporte</a>
      </div>
    </div>
  </div>

</div>