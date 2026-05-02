<div class="container my-5 c-menu-container">

  <!-- Texto de bienvenida -->
  <div class="row mb-5 text-center justify-content-center">
    <div class="col-lg-8 col-12">
      <div class="c-menu-welcome">
        <h2 class="c-menu-title">BIENVENIDO/A "<?php echo getNombreUsuario(); ?>"</h2>
        <p class="c-menu-subtitle">Accedé a las opciones disponibles para tu cuenta y explorá el shopping.</p>
      </div>
    </div>
  </div>

  <!-- Carrusel -->
  <div class="row mb-5 justify-content-center">
    <div class="col-lg-10 col-12">
      <?php include __DIR__ . "/../components/carousel.php"; ?>
    </div>
  </div>

  <!-- Grilla de locales y promociones -->
  <div class="row mb-4 align-items-stretch">
    <div class="col-lg-8 col-12 mb-3 mb-lg-0">
      <div class="c-menu-card d-flex flex-column justify-content-center align-items-center h-100">
        <i class="bi bi-shop c-menu-icon-orange"></i>

        <h3 class="c-menu-card-title">LOCALES</h3>
        <p class="c-menu-card-text text-center mb-4">Ver todos los locales del shopping.</p>
        <a href="<?php echo app_path('src/view/pages/local/local_list.php'); ?>" class="c-btn-primary">Ver Locales</a>
      </div>
    </div>
    <div class="col-lg-4 col-12">
      <div class="c-menu-img-placeholder h-100 d-flex justify-content-center align-items-center">
        <img src="<?php echo app_path('src/img/marcasLogos.png') ?>" alt="Logos de marcas en el shopping" class="c-menu-img">
      </div>
    </div>
  </div>

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
        <p class="c-menu-card-text text-center mb-4">Buscá promociones y consultá tus usos de promociones.</p>
        <a href="<?php echo app_path('src/view/pages/promocion/promocion_list.php'); ?>" class="c-btn-primary">Buscar Promociones</a>
      </div>
    </div>
  </div>

  <!-- Novedades y usos -->
  <div class="row g-4">
    <div class="col-md-6 col-12">
      <div class="c-menu-card h-100 text-center">
        <i class="bi bi-newspaper c-menu-icon-orange"></i>
        <h3 class="c-menu-card-title mt-3">NOVEDADES</h3>
        <p class="c-menu-card-text mb-4">Enterate de las últimas publicaciones disponibles.</p>
        <a href="<?php echo app_path('src/view/pages/novedad/novedad_list.php'); ?>" class="c-btn-primary">Ver Novedades</a>
      </div>
    </div>

    <div class="col-md-6 col-12">
      <div class="c-menu-card h-100 text-center">
        <i class="bi bi-tag c-menu-icon-orange"></i>
        <h3 class="c-menu-card-title mt-3">MIS USOS DE PROMOCIONES</h3>
        <p class="c-menu-card-text mb-4">Revisá el historial de promociones que utilizaste.</p>
        <a href="<?php echo app_path('src/view/pages/uso_promocion/mis_usos_cliente.php'); ?>" class="c-btn-primary">Ver Usos</a>
      </div>
    </div>
  </div>

</div>