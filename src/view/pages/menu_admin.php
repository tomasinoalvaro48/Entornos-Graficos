<div class="container mt-5">
  <div class="row mb-5">
    <div class="col-12">
      <h1 class="text-center mb-4">Panel de Administración</h1>
      <p class="text-center text-muted">Bienvenido al panel administrativo. Aquí puedes gestionar todos los aspectos del sitio.</p>
    </div>
  </div>

  <!-- SECCIÓN: DASHBOARD Y ESTADÍSTICAS -->
  <div class="row mb-5">

    <div class="col-md-6 col-lg-4 mb-3">
      <div class="card h-100 shadow-sm">
        <div class="card-body text-center">
          <i class="bi bi-newspaper" style="font-size: 2rem; color: #000000;"></i>
          <h5 class=" card-title mt-3">Novedades</h5>
          <p class="card-text">Gestionar Novedades. Crear novedades para Clientes o Dueños.</p>
          <a href="<?php echo app_path('src/view/pages/novedad/novedad_list.php'); ?>" class="btn btn-dark btn-sm">Administrar Novedades</a>
        </div>
      </div>
    </div>


    <div class="col-md-6 col-lg-4 mb-3">
      <div class="card h-100 shadow-sm">
        <div class="card-body text-center">
          <i class="bi bi-graph-up" style="font-size: 2rem; color: #0d6efd;"></i>
          <h5 class="card-title mt-3">Dashboard</h5>
          <p class="card-text">Ver estadísticas y reportes generales del sitio.</p>
          <a href="#" class="btn btn-primary btn-sm">Ir al Dashboard</a>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-4 mb-3">
      <div class="card h-100 shadow-sm">
        <div class="card-body text-center">
          <i class="bi bi-bar-chart" style="font-size: 2rem; color: #198754;"></i>
          <h5 class="card-title mt-3">Reporte de uso de promociones</h5>
          <p class="card-text">Ver todas las promociones y sus usos.</p>
          <a href="<?php echo app_path('src/view/pages/uso_promocion/reporte_promociones.php'); ?>" class="btn btn-success btn-sm">Ver Reporte</a>
        </div>
      </div>
    </div>

  </div>

  <!-- SECCIÓN: GESTIÓN DE USUARIOS -->
  <div class="row mb-5">
    <div class="col-12">
      <h3 class="mb-4">Gestión de Usuarios</h3>
    </div>

    <div class="col-md-6 col-lg-4 mb-3">
      <div class="card h-100 shadow-sm">
        <div class="card-body text-center">
          <i class="bi bi-people" style="font-size: 2rem; color: #0dcaf0;"></i>
          <h5 class="card-title mt-3">Clientes</h5>
          <p class="card-text">Gestionar cuentas de clientes, ver perfiles y actividades.</p>
          <a href="#" class="btn btn-info btn-sm">Administrar Clientes</a>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-4 mb-3">
      <div class="card h-100 shadow-sm">
        <div class="card-body text-center">
          <i class="bi bi-shop" style="font-size: 2rem; color: #ff0000;"></i>
          <h5 class="card-title mt-3">Dueños de Locales</h5>
          <p class="card-text">Aprobar o rechazar cuentas de Dueños pendientes.</p>
          <a href="<?php echo app_path('src/view/pages/usuario/validar_cuentas_dueno.php'); ?>?estado=pendiente" class="btn btn-danger btn-sm">Administrar Dueños</a>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-4 mb-3">
      <div class="card h-100 shadow-sm">
        <div class="card-body text-center">
          <i class="bi bi-shop" style="font-size: 2rem; color: #ff0000;"></i>
          <h5 class="card-title mt-3">Ver Todas las Duentas de Dueños de Locales</h5>
          <a href="<?php echo app_path('src/view/pages/usuario/validar_cuentas_dueno.php'); ?>" class="btn btn-danger btn-sm">Ver Dueños</a>
        </div>
      </div>
    </div>

  </div>

  <!-- SECCIÓN: GESTIÓN DE CONTENIDO -->
  <div class="row mb-5">
    <div class="col-12">
      <h3 class="mb-4">Gestión de Contenido</h3>
    </div>

    <div class="col-md-6 col-lg-4 mb-3">
      <div class="card h-100 shadow-sm">
        <div class="card-body text-center">
          <i class="bi bi-shop" style="font-size: 2rem; color: #fd7e14;"></i>
          <h5 class="card-title mt-3">Locales</h5>
          <p class="card-text">Crear, editar y eliminar locales del sistema.</p>
          <a href="<?php echo app_path('src/view/pages/local/local_list.php'); ?>" class="btn btn-warning btn-sm">Gestionar Locales</a>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-4 mb-3">
      <div class="card h-100 shadow-sm">
        <div class="card-body text-center">
          <i class="bi bi-tag" style="font-size: 2rem; color: #20c997;"></i>
          <h5 class="card-title mt-3">Promociones</h5>
          <p class="card-text">Aprobar y denegar promociones.</p>
          <a href="<?php echo app_path('src/view/pages/promocion/validar_promociones.php'); ?>" class="btn btn-success btn-sm">Gestionar Promociones</a>
        </div>
      </div>
    </div>

  </div>