<div class="container">

  <!-- Texto de bienvenida -->
  <div class="row m-lg-5 m-3 text-center justify-content-center">
    <div class="col-lg-8 col-12">
      <h2 class="c-menu-title">BIENVENIDO DUEÑO</h2>
    </div>
  </div>

  <!-- Promociones y Usos -->
  <div class="row mb-2">
    <div class="col-md-6 col-12 mb-2">
      <div class="c-menu-card text-center">
        <i class="bi bi-tag c-menu-icon-orange"></i>
        <h3 class="c-menu-card-title">MIS PROMOCIONES</h3>
        <p class="c-menu-card-text">Ver, crear o eliminar tus promociones.</p>
        <a href="<?php echo app_path('src/view/pages/promocion/promocion_list.php'); ?>" class="c-btn-primary">Gestionar Promociones</a>
      </div>
    </div>

    <div class="col-md-6 col-12">
      <div class="c-menu-card text-center">
        <i class="bi bi-hand-thumbs-up c-menu-icon-orange"></i>
        <h3 class="c-menu-card-title">USOS DE PROMOCIONES</h3>
        <p class="c-menu-card-text">Aceptar o rechazar usos de promociones.</p>
        <a href="<?php echo app_path('src/view/pages/uso_promocion/validar_uso_promocion.php'); ?>" class="c-btn-primary">Gestionar Usos</a>
      </div>
    </div>
  </div>

  <!-- Grilla de locales -->
  <div class="row mb-5">
    <div class="col-12">
      <div class="c-menu-card d-flex flex-column justify-content-center align-items-center">
        <i class="bi bi-shop c-menu-icon-orange"></i>
        <h3 class="c-menu-card-title">MIS LOCALES</h3>
        <p class="c-menu-card-text text-center mb-4">Visualiza y gestiona los locales cargados.</p>
        <a href="<?php echo app_path('src/view/pages/local/local_list.php'); ?>" class="c-btn-primary">Ver Locales</a>
      </div>
    </div>
  </div>

</div>