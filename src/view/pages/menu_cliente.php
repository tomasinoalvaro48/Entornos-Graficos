<div class="container">
  <!-- Texto de bienvenida -->
  <div class="row m-5 text-center justify-content-center">
    <div class="col-lg-8 col-12">
      <h2 class="c-menu-title">BIENVENIDO "<?php echo getNombreUsuario(); ?>"</h2>
    </div>
  </div>

  <!-- Carousel -->
  <div class="row mb-5">
    <div class="col-12">
      <?php include __DIR__ . "/../components/carousel.php"; ?>
    </div>
  </div>

  <!-- Locales -->
  <div class="row mb-2">
    <div class="col d-flex flex-column justify-content-center align-items-center">
      <i class="bi bi-shop c-menu-icon-orange"></i><h2 class="c-menu-title">NUESTROS LOCALES</h2>
    </div>
  </div>
  <div class="row">
    <?php
      if (count($locales) > 0) {
        foreach (array_slice($locales, 0, 8) as $local) {
    ?>
    <div class="col-lg-3 col-md-4 col-6 mb-2">
      <a href="<?php echo app_path('src/view/pages/local/local_list.php'); ?>" class="c-menu-card-link">
        <div class="c-menu-card d-flex flex-column justify-content-center align-items-center">
          <img src="<?php echo app_path('src/img/locales/' . $local->imagenLocal) ?>" alt="Imagen del local <?php echo $local->nombreLocal ?>" class="c-menu-card-img">
          <p class="c-menu-card-text"><?php echo $local->nombreLocal ?></p>
        </div>  
      </a>
    </div>
    <?php
      }
    }
    ?>
  </div>
  <div class="row align-items-stretch mb-5">
    <div class="col-12">
      <div class="c-menu-card d-flex flex-column justify-content-center align-items-center">
        <p class="c-menu-card-text text-center">Encontrá las mejores marcas y locales comerciales en un solo lugar.</p>
        <a href="<?php echo app_path('src/view/pages/local/local_list.php'); ?>" class="c-btn-primary">Ver Locales</a>
      </div>
    </div>
  </div>


  <!-- Promociones -->
  <div class="row mb-2">
    <div class="col d-flex flex-column justify-content-center align-items-center">
      <i class="bi bi-tag c-menu-icon-orange"></i><h2 class="c-menu-title">PROMOCIONES PARA VOS</h2>
    </div>
  </div>
  <div class="row">
    <?php
      if (count($promociones) > 0) {
        foreach (array_slice($promociones, 0, 8) as $promo) {
    ?>
        <div class="col-lg-3 col-md-4 col-6 mb-2">
          <a href="<?php echo app_path('src/view/pages/promocion/promocion_list.php'); ?>" class="c-menu-card-link">
            <div class="c-menu-card d-flex flex-column justify-content-center align-items-center">
              <img src="<?php echo app_path('src/img/promociones/' . $promo->imagenPromo) ?>" alt="Imagen de la promoción <?php echo $promo->imagenPromol ?>" class="c-menu-card-img">
              <p class="c-menu-card-text"><?php echo $promo->textoPromo ?></p>
            </div>  
          </a>
        </div>
    <?php
      }
      }
    ?>
  </div>
    <div class="col-12 order-1 order-lg-2">
      <div class="c-menu-card d-flex flex-column justify-content-center align-items-center h-100">
        <p class="c-menu-card-text text-center">Aprovechá los descuentos que tenemos preparados para vos y tu familia.</p>
        <a href="<?php echo app_path('src/view/pages/local/local_list.php'); ?>" class="c-btn-primary">Ver Todas las Promociones</a>
      </div>
    </div>
  </div>
</div>
