<div class="col-12 col-lg-4">
  <div class="c-site-footer__section">
    <p class="c-site-footer__eyebrow">Explorá</p>
    <h5 class="c-site-footer__title">Mapa del sitio</h5>
    <div class="list-group text-center">
      <a class="list-group-item list-group-item-action" href="<?php echo app_path(); ?>">Inicio</a>
      <a class="list-group-item list-group-item-action" href="<?php echo app_path('src/view/pages/local/local_list.php'); ?>">Locales</a>
      <a class="list-group-item list-group-item-action" href="<?php echo app_path('src/view/pages/promocion/promocion_list.php'); ?>">Promociones</a>
      <?php if (!$tipoUsuario) { ?>
        <a class="list-group-item list-group-item-action" href="<?php echo app_path('src/view/pages/auth/login.php'); ?>">Iniciar sesión</a>
        <a class="list-group-item list-group-item-action" href="<?php echo app_path('src/view/pages/auth/signin.php'); ?>">Registrarse</a>
        <a class="list-group-item list-group-item-action" href="<?php echo app_path('src/view/pages/auth/signin_dueno.php'); ?>">Registrarse como Dueño</a>
      <?php } else if ($tipoUsuario === TipoUsuario::CLIENTE->value) { ?>
        <a class="list-group-item list-group-item-action" href="<?php echo app_path('src/view/pages/novedad/novedad_list.php'); ?>">Novedades</a>
        <a class="list-group-item list-group-item-action" href="<?php echo app_path('src/view/pages/uso_promocion/promos_cliente.php'); ?>">Buscar promociones</a>
        <a class="list-group-item list-group-item-action" href="<?php echo app_path('src/view/pages/uso_promocion/mis_usos_cliente.php'); ?>">Mis usos de promociones</a>
      <?php } else if ($tipoUsuario === TipoUsuario::DUENO->value) { ?>
        <a class="list-group-item list-group-item-action" href="<?php echo app_path('src/view/pages/local/local_list.php'); ?>">Gestión de locales</a>
        <a class="list-group-item list-group-item-action" href="<?php echo app_path('src/view/pages/promocion/promocion_list.php'); ?>">Gestión de promociones</a>
      <?php } else if ($tipoUsuario === TipoUsuario::ADMIN->value) { ?>
        <a class="list-group-item list-group-item-action" href="<?php echo app_path('src/view/pages/local/local_list.php'); ?>">Administrar locales</a>
      <?php } ?>
    </div>
  </div>
</div>