<div class="container my-5 c-menu-container">

  <!-- Texto de bienvenida -->
  <div class="row mb-5 text-center justify-content-center">
    <div class="col-lg-8 col-12">
      <div class="c-menu-welcome">
        <h2 class="c-menu-title">BIENVENIDOS A RIVENDELL PLAZA</h2>
        <p class="c-menu-subtitle">Más que un centro comercial, es tu refugio de lujo y confort. Ven a descubrir lo extraordinario.</p>
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
  <!-- Fila 1: Locales -->
  <div class="row mb-4 align-items-stretch">
    <div class="col-lg-8 col-12 mb-3 mb-lg-0">
      <div class="c-menu-card d-flex flex-column justify-content-center align-items-center h-100">
        <h3 class="c-menu-card-title">NUESTROS LOCALES</h3>
        <p class="c-menu-card-text text-center mb-4">Encontrá las mejores marcas y locales comerciales en un solo lugar.</p>
        <a href="<?php echo app_path('src/view/pages/local/local_list.php'); ?>" class="c-btn-primary">Ver Locales</a>
      </div>
    </div>
    <div class="col-lg-4 col-12">
      <div class="c-menu-img-placeholder h-100 d-flex justify-content-center align-items-center">
        <img src="<?php echo app_path('src/img/marcasLogos.png') ?>" alt="Logos de marcas en el shopping" class="c-menu-img">
      </div>
    </div>
  </div>

  <!-- Fila 2: Promociones -->
  <div class="row align-items-stretch">
    <!-- En pantallas chicas (flex-column-reverse) o grandes, podemos usar orden -->
    <div class="col-lg-4 col-12 mb-3 mb-lg-0 order-2 order-lg-1">
      <div class="c-menu-img-placeholder h-100 d-flex justify-content-center align-items-center">
        <img src="<?php echo app_path('src/img/promociones.png') ?>" alt="Imagen de promociones" class="c-menu-img">
      </div>
    </div>
    <div class="col-lg-8 col-12 order-1 order-lg-2 mb-3 mb-lg-0">
      <div class="c-menu-card d-flex flex-column justify-content-center align-items-center h-100">
        <h3 class="c-menu-card-title">PROMOCIONES EXCLUSIVAS</h3>
        <p class="c-menu-card-text text-center mb-4">Aprovechá los descuentos que tenemos preparados para vos y tu familia.</p>
        <a href="<?php echo app_path('src/view/pages/promocion/promocion_list.php'); ?>" class="c-btn-primary">Ver Promociones</a>
      </div>
    </div>
  </div>

</div>