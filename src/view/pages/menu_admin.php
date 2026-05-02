<div class="container my-5 c-menu-container">

  <!-- Texto de bienvenida -->
  <div class="row mb-5 text-center justify-content-center">
    <div class="col-lg-8 col-12">
      <div class="c-menu-welcome">
        <h2 class="c-menu-title">PANEL DE ADMINISTRACIÓN</h2>
        <p class="c-menu-subtitle">Gestiona todos los aspectos del sitio desde este panel.</p>
      </div>
    </div>
  </div>

  <!-- Carrusel -->
  <div class="row mb-5 justify-content-center">
    <div class="col-lg-10 col-12">
      <?php include __DIR__ . "/../components/carousel.php"; ?>
    </div>
  </div>

  <!-- Grilla de locales -->
  <div class="row mb-4 align-items-stretch">
    <div class="col-lg-8 col-12 mb-3 mb-lg-0">
      <div class="c-menu-card d-flex flex-column justify-content-center align-items-center h-100">
        <i class="bi bi-shop c-menu-icon-orange"></i>
        <h3 class="c-menu-card-title">LOCALES</h3>
        <p class="c-menu-card-text text-center mb-4">Crear, editar y eliminar locales del sistema.</p>
        <a href="<?php echo app_path('src/view/pages/local/local_list.php'); ?>" class="c-btn-primary">Gestionar Locales</a>
      </div>
    </div>
    <div class="col-lg-4 col-12">
      <div class="c-menu-img-placeholder h-100 d-flex justify-content-center align-items-center">
        <img src="<?php echo app_path('src/img/marcasLogos.png') ?>" alt="Logos de marcas en el shopping" class="c-menu-img">
      </div>
    </div>
  </div>

  <!-- Grilla de promociones con imagen -->
  <div class="row align-items-stretch mb-5">
    <div class="col-lg-4 col-12 mb-3 mb-lg-0 order-2 order-lg-1">
      <div class="c-menu-img-placeholder h-100 d-flex justify-content-center align-items-center">
        <img src="<?php echo app_path('src/img/promociones.png') ?>" alt="Imagen de promociones" class="c-menu-img">
      </div>
    </div>
    <div class="col-lg-8 col-12 order-1 order-lg-2 mb-3 mb-lg-0">
      <div class="c-menu-card d-flex flex-column justify-content-center align-items-center h-100">
        <i class="bi bi-tag c-menu-icon-orange"></i>
        <h3 class="c-menu-card-title">PROMOCIONES</h3>
        <p class="c-menu-card-text text-center mb-4">Aprobar y denegar promociones de dueños.</p>
        <a href="<?php echo app_path('src/view/pages/promocion/validar_promociones.php'); ?>" class="c-btn-primary">Gestionar Promociones</a>
      </div>
    </div>
  </div>

  <!-- Otras funcionalidades -->
  <div class="row g-4">
    <div class="col-md-6 col-lg-4 col-12">
      <div class="c-menu-card h-100 text-center">
        <i class="bi bi-newspaper c-menu-icon-orange"></i>
        <h3 class="c-menu-card-title mt-3">NOVEDADES</h3>
        <p class="c-menu-card-text mb-4">Gestionar novedades para clientes.</p>
        <a href="<?php echo app_path('src/view/pages/novedad/novedad_list.php'); ?>" class="c-btn-primary">Administrar Novedades</a>
      </div>
    </div>

    <div class="col-md-6 col-lg-4 col-12">
      <div class="c-menu-card h-100 text-center">
        <i class="bi bi-person-check c-menu-icon-orange"></i>
        <h3 class="c-menu-card-title mt-3">DUEÑOS</h3>
        <p class="c-menu-card-text mb-4">Gestionar cuentas de dueños.</p>
        <a href="<?php echo app_path('src/view/pages/usuario/validar_cuentas_dueno.php'); ?>" class="c-btn-primary">Administrar Dueños</a>
      </div>
    </div>

    <div class="col-md-6 col-lg-4 col-12">
      <div class="c-menu-card h-100 text-center">
        <i class="bi bi-bar-chart c-menu-icon-orange"></i>
        <h3 class="c-menu-card-title mt-3">REPORTES DE USO DE PROMOCIONES</h3>
        <p class="c-menu-card-text mb-4">Ver todas las promociones y sus usos.</p>
        <a href="<?php echo app_path('src/view/pages/uso_promocion/reporte_promociones.php'); ?>" class="c-btn-primary">Ver Reporte</a>
      </div>
    </div>
  </div>

</div>