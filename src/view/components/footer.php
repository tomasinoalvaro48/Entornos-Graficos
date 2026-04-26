<?php
require_once __DIR__ . "/../../controller/auth.php";
require_once __DIR__ . "/../../enums.php";

$tipoUsuario = getTipoUsuario();
?>

<div class="c-site-footer card border-0">
  <div class="card-body c-site-footer__body">
    <div class="container-fluid">
      <div class="row g-4 align-items-start">

        <!-- Mapa del sitio -->
        <?php include __DIR__ . "/mapa_sitio.php"; ?>

        <!-- Dónde estamos -->
        <div class="col-12 col-lg-4">
          <div class="c-site-footer__section">
            <p class="c-site-footer__eyebrow">Ubicación</p>
            <h5 class="c-site-footer__title">Dónde estamos</h5>
            <p class="c-site-footer__text">Encontranos en el mapa.</p>
            <div class="ratio ratio-4x3 c-site-footer__map">
              <iframe
                class="c-site-footer__iframe"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d87798.73420402437!2d7.824284571523132!3d46.55341446915892!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x478fa0073b1165c7%3A0x5392dbb55902c31!2sLauterbrunnen%2C%20Switzerland!5e0!3m2!1sen!2sar!4v1777058542666!5m2!1sen!2sar"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
              </iframe>
            </div>
          </div>
        </div>

        <!-- Contacto -->
        <div class="col-12 col-lg-4">
          <div class="c-site-footer__section">
            <p class="c-site-footer__eyebrow">Contacto</p>
            <h5 class="c-site-footer__title">Escribinos</h5>
            <form class="c-site-footer__form" method="post" action="<?php echo app_path('src/controller/handle_contacto.php'); ?>">
              <!-- Si el usuario no esá logueado pedimos nombre e email para verificar que es cliente -->
              <?php if (!$tipoUsuario) { ?>
                <label for="contacto_nombre" class="form-label">Nombre</label>
                <input
                  id="contacto_nombre"
                  name="contacto_nombre"
                  type="text"
                  class="form-control form-control-sm"
                  autocomplete="name"
                  required />
                <label for="contacto_email" class="form-label">Email</label>
                <input
                  id="contacto_email"
                  name="contacto_email"
                  type="email"
                  class="form-control form-control-sm"
                  autocomplete="email"
                  required />
              <?php } ?>
              <label for="contacto_mensaje" class="form-label">Mensaje</label>
              <textarea
                id="contacto_mensaje"
                name="contacto_mensaje"
                class="form-control form-control-sm"
                rows="4"
                required></textarea>
              <button type="submit" class="btn btn-success btn-sm c-site-footer__button" id="botonContacto" name="botonContacto">Enviar</button>
            </form>
          </div>
        </div>

      </div>
    </div>

    <!-- Términos, privacidad y copyright -->
    <div class="c-site-footer__bottom">
      <div class="c-site-footer__legal">
        <a href="<?php echo app_path('src/view/pages/terminos.php'); ?>" class="text-decoration-none">Términos y condiciones</a>
        <span aria-hidden="true">|</span>
        <a href="<?php echo app_path('src/view/pages/politica_privacidad.php'); ?>" class="text-decoration-none">Política de privacidad</a>
      </div>
      <p class="c-site-footer__copy">Copyright &copy; 2026 - Todos los derechos reservados | Contacto: rivendell.plaza@gmail.com</p>
    </div>

  </div>
</div>