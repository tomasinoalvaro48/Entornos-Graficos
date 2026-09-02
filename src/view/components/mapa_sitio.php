<div>
  <p class="c-footer-text mb-1">Explorá</p>
  <h5 class="c-footer-section-title">Mapa del sitio</h5>
  <div class="d-flex flex-column text-start">
    <a class="c-footer-link" href="<?php echo app_path(); ?>">Inicio</a>

    <?php if (!$tipoUsuario) { ?>
      <a class="c-footer-link" href="<?php echo app_path('src/view/pages/auth/login.php'); ?>">Iniciar sesión</a>
      <a class="c-footer-link" href="<?php echo app_path('src/view/pages/auth/signin.php'); ?>">Registrarse</a>
      <a class="c-footer-link" href="<?php echo app_path('src/view/pages/auth/signin_dueno.php'); ?>">Registrarse como Dueño</a>
      <a class="c-footer-link" href="<?php echo app_path('src/view/pages/local/local_list.php'); ?>">Locales</a>
      <a class="c-footer-link" href="<?php echo app_path('src/view/pages/promocion/promocion_list.php'); ?>">Promociones</a>


    <?php } else if ($tipoUsuario === TipoUsuario::CLIENTE->value) { ?>
      <a class="c-footer-link" href="<?php echo app_path('src/view/pages/local/local_list.php'); ?>">Locales</a>
      <a class="c-footer-link" href="<?php echo app_path('src/view/pages/promocion/promocion_list.php'); ?>">Buscar promociones</a>
      <a class="c-footer-link ps-4" href="<?php echo app_path('src/view/pages/uso_promocion/mis_usos_cliente.php'); ?>">Mis usos de promociones</a>
      <a class="c-footer-link" href="<?php echo app_path('src/view/pages/novedad/novedad_list.php'); ?>">Novedades</a>
    
    <?php } else if ($tipoUsuario === TipoUsuario::DUENO->value) { ?>
      <a class="c-footer-link" href="<?php echo app_path('src/view/pages/local/local_list.php'); ?>">Gestión de locales</a>
      <a class="c-footer-link" href="<?php echo app_path('src/view/pages/promocion/promocion_list.php'); ?>">Gestión de promociones</a>
      <a class="c-footer-link ps-4" href="<?php echo app_path('src/view/pages/promocion/create_promocion.php'); ?>">Crear promoción</a>
      <a class="c-footer-link ps-4" href="<?php echo app_path('src/view/pages/uso_promocion/validar_uso_promocion.php'); ?>">Gestionar Uso de Promociones</a>

    <?php } else if ($tipoUsuario === TipoUsuario::ADMIN->value) { ?>
      <a class="c-footer-link" href="<?php echo app_path('src/view/pages/local/local_list.php'); ?>">Administrar locales</a>
      <a class="c-footer-link ps-4" href="<?php echo app_path('src/view/pages/local/create_local.php'); ?>">Crear local</a>
      <a class="c-footer-link" href="<?php echo app_path('src/view/pages/promocion/validar_promociones.php'); ?>">Administrar promociones</a>
      <a class="c-footer-link ps-4" href="<?php echo app_path('src/view/pages/uso_promocion/reporte_promociones.php'); ?>">Reporte de Uso de Promociones</a>
      <a class="c-footer-link" href="<?php echo app_path('src/view/pages/novedad/novedad_list.php'); ?>">Administrar novedades</a>
      <a class="c-footer-link ps-4" href="<?php echo app_path('src/view/pages/novedad/novedad_create.php'); ?>">Crear novedad</a>
      <a class="c-footer-link" href="<?php echo app_path('src/view/pages/usuario/validar_cuentas_dueno.php'); ?>">Administrar Dueños</a>

    <?php } ?>
  </div>
</div>