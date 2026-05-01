<?php
require_once __DIR__ . "/../../controller/auth.php";
require_once __DIR__ . "/../../enums.php";

$tipoUsuario = getTipoUsuario();
?>

<?php
require_once __DIR__ . "/../../controller/auth.php";
require_once __DIR__ . "/../../enums.php";

$tipoUsuario = getTipoUsuario();
?>

<footer class="c-footer">
  <div class="container-fluid">
    <div class="row align-items-start">
      <div class="col-12 col-lg-4">

        <!-- Mapa del sitio -->
        <?php include __DIR__ . "/mapa_sitio.php"; ?>
      </div>
      <!-- Dónde estamos -->
      <div class="col-12 col-lg-4">
        <div>
          <p class="c-footer-text mb-1">Ubicación</p>
          <h5 class="c-footer-section-title">Dónde estamos</h5>
          <p class="c-footer-text">Encontranos en el mapa.</p>
          <div class="ratio ratio-4x3">
            <iframe
              class="c-footer-iframe"
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d87798.73420402437!2d7.824284571523132!3d46.55341446915892!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x478fa0073b1165c7%3A0x5392dbb55902c31!2sLauterbrunnen%2C%20Switzerland!5e0!3m2!1sen!2sar!4v1777058542666!5m2!1sen!2sar"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade">
            </iframe>
          </div>
        </div>
      </div>

      <!-- Contacto -->
      <div class="col-12 col-lg-4 mt-4 mt-lg-0">
        <div>
          <p class="c-footer-text mb-1">Contacto</p>
          <h5 class="c-footer-section-title">Escribinos</h5>
          <form method="post" action="<?php echo app_path('src/controller/handle_contacto.php'); ?>">
            <!-- Si el usuario no esá logueado pedimos nombre e email para verificar que es cliente -->
            <?php if (!$tipoUsuario) { ?>
              <label for="contacto_nombre" class="form-label c-footer-text mb-1">Nombre</label>
              <input
                id="contacto_nombre"
                name="contacto_nombre"
                type="text"
                class="c-form-input mb-3"
                autocomplete="name"
                required />
              <label for="contacto_email" class="form-label c-footer-text mb-1">Email</label>
              <input
                id="contacto_email"
                name="contacto_email"
                type="email"
                class="c-form-input mb-3"
                autocomplete="email"
                required />
            <?php } ?>
            <label for="contacto_mensaje" class="form-label c-footer-text mb-1">Mensaje</label>
            <textarea
              id="contacto_mensaje"
              name="contacto_mensaje"
              class="c-form-input mb-3"
              rows="4"
              required></textarea>
            <button type="submit" class="c-btn-primary" id="botonContacto" name="botonContacto">Enviar</button>
          </form>
        </div>
      </div>

    </div>
  </div>

  <!-- Términos, privacidad y copyright -->
  <div class="c-footer-bottom">
    <div class="mb-2">
      <a href="<?php echo app_path('src/view/pages/terminos.php'); ?>">Términos y condiciones</a>
      <span aria-hidden="true" class="text-secondary">|</span>
      <a href="<?php echo app_path('src/view/pages/politica_privacidad.php'); ?>">Política de privacidad</a>
    </div>
    <p class="mb-0">Copyright &copy; 2026 - Todos los derechos reservados | Contacto: rivendell.plaza@gmail.com</p>
  </div>
</footer>