<?php
include __DIR__ . "/../components/carousel.php";
?>

<div class="container py-5">
  <div class="row mb-4">
    <div class="col-12 text-center">
      <h1 class="mb-3">Panel del Dueño</h1>
      <p class="text-muted mb-0">Gestiona tus locales y mantente al día con las novedades del sistema.</p>
    </div>
  </div>

  <div class="row g-4">
    <div class="col-md-6 col-lg-3">
      <div class="card h-100 shadow-sm">
        <div class="card-body text-center">
          <i class="bi bi-shop" style="font-size: 2rem; color: #fd7e14;"></i>
          <h5 class="card-title mt-3">Mis Locales</h5>
          <p class="card-text">Visualiza, edita o elimina los locales cargados.</p>
          <a href="/src/view/pages/local/local_list.php" class="btn btn-warning btn-sm">Ver Locales</a>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3">
      <div class="card h-100 shadow-sm">
        <div class="card-body text-center">
          <i class="bi bi-plus-circle" style="font-size: 2rem; color: #198754;"></i>
          <h5 class="card-title mt-3">Crear Local</h5>
          <p class="card-text">Registra un nuevo local para ampliar tu oferta.</p>
          <a href="/src/view/pages/local/create_local.php" class="btn btn-success btn-sm">Nuevo Local</a>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3">
      <div class="card h-100 shadow-sm">
        <div class="card-body text-center">
          <i class="bi bi-megaphone" style="font-size: 2rem; color: #0d6efd;"></i>
          <h5 class="card-title mt-3">Novedades</h5>
          <p class="card-text">Consulta las novedades publicadas para tus clientes.</p>
          <a href="/src/view/pages/novedad/novedad_list.php" class="btn btn-primary btn-sm">Ver Novedades</a>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3">
      <div class="card h-100 shadow-sm">
        <div class="card-body text-center">
          <i class="bi bi-pencil-square" style="font-size: 2rem; color: #20c997;"></i>
          <h5 class="card-title mt-3">Publicar Novedad</h5>
          <p class="card-text">Comparte anuncios y noticias importantes.</p>
          <a href="/src/view/pages/novedad/novedad_create.php" class="btn btn-info btn-sm text-white">Crear Novedad</a>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3">
      <div class="card h-100 shadow-sm">
        <div class="card-body text-center">
          <i class="bi bi-shop" style="font-size: 2rem; color: #fd7e14;"></i>
          <h5 class="card-title mt-3">Mis Promociones</h5>
          <p class="card-text">Ver o eliminar mis promociones.</p>
          <a href="/src/view/pages/promocion/promocion_list.php" class="btn btn-warning btn-sm">Ver Promociones</a>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3">
      <div class="card h-100 shadow-sm">
        <div class="card-body text-center">
          <i class="bi bi-plus-circle" style="font-size: 2rem; color: #198754;"></i>
          <h5 class="card-title mt-3">Crear Promoción</h5>
          <p class="card-text">Crear una nueva promoción.</p>
          <a href="/src/view/pages/promocion/create_promocion.php" class="btn btn-success btn-sm">Nueva Promoción</a>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-5">
    <div class="col-12 text-center">
      <a href="/src/controller/handle_logout.php" class="btn btn-outline-secondary">Cerrar sesión</a>
    </div>
  </div>
</div>