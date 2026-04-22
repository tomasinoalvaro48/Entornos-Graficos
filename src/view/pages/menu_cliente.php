<?php
include __DIR__ . "/../components/carousel.php";
?>

<div class="container text-align-center">
  <div class="row">
    <div class="col-xl-8">
      <a class="btn btn-primary btn-lg" href="#">Opciones de la Cuenta</a>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <a class="btn btn-secondary" href="<?php echo app_path('src/view/pages/novedad/novedad_list.php'); ?>">Novedades</a>
    </div>
  </div>

  <div class="col-md-6 col-lg-3">
    <div class="card h-100 shadow-sm">
      <div class="card-body text-center">
        <i class="bi bi-tag" style="font-size: 2rem; color: #198754;"></i>
        <h5 class="card-title mt-3">Promociones solicitadas</h5>
        <p class="card-text">Ver mis usos de promociones.</p>
        <a href="<?php echo app_path('src/view/pages/uso_promocion/mis_usos_cliente.php'); ?>" class="btn btn-success btn-sm">
          Ver Promociones
        </a>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-lg-3">
    <div class="card h-100 shadow-sm">
      <div class="card-body text-center">
        <i class="bi bi-tag" style="font-size: 2rem; color: #198754;"></i>
        <h5 class="card-title mt-3">Buscar promociones</h5>
        <p class="card-text">Buscar promociones por código de local.</p>
        <a href="<?php echo app_path('src/view/pages/uso_promocion/promos_cliente.php'); ?>" class="btn btn-success btn-sm">
          Buscar Promociones
        </a>
      </div>
    </div>
  </div>
</div>