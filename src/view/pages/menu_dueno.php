<div class="container my-5 c-menu-container">

  <!-- Texto de bienvenida -->
  <div class="row mb-5 text-center justify-content-center">
    <div class="col-lg-8 col-12">
      <div class="c-menu-welcome">
        <h2 class="c-menu-title">BIENVENIDO/A DUEÑO</h2>
        <p class="c-menu-subtitle">Gestiona tus locales y promociones desde este panel.</p>
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
        <h3 class="c-menu-card-title">MIS LOCALES</h3>
        <p class="c-menu-card-text text-center mb-4">Visualiza y gestiona los locales cargados.</p>
        <a href="<?php echo app_path('src/view/pages/local/local_list.php'); ?>" class="c-btn-primary">Ver Locales</a>
      </div>
    </div>
    <div class="col-lg-4 col-12">
      <div class="c-menu-img-placeholder h-100 d-flex justify-content-center align-items-center">
        <img src="<?php echo app_path('src/img/marcasLogos.png') ?>" alt="Logos de marcas en el shopping" class="c-menu-img">
      </div>
    </div>
  </div>

  <!-- Promociones y Usos -->
  <div class="row g-4">
    <div class="col-md-6 col-12">
      <div class="c-menu-card h-100 text-center">
        <i class="bi bi-tag c-menu-icon-orange"></i>
        <h3 class="c-menu-card-title mt-3">MIS PROMOCIONES</h3>
        <p class="c-menu-card-text mb-4">Ver, crear o eliminar tus promociones.</p>
        <a href="<?php echo app_path('src/view/pages/promocion/promocion_list.php'); ?>" class="c-btn-primary">Gestionar Promociones</a>
      </div>
    </div>

    <div class="col-md-6 col-12">
      <div class="c-menu-card h-100 text-center">
        <i class="bi bi-hand-thumbs-up c-menu-icon-orange"></i>
        <h3 class="c-menu-card-title mt-3">USOS DE PROMOCIONES</h3>
        <p class="c-menu-card-text mb-4">Aceptar o rechazar usos de promociones.</p>
        <a href="<?php echo app_path('src/view/pages/uso_promocion/validar_uso_promocion.php'); ?>" class="c-btn-primary">Gestionar Usos</a>
      </div>
    </div>
  </div>

</div>