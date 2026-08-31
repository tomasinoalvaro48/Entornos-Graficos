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
              src="https://maps.google.com/maps?q=-32.894901,-60.692411&hl=es&z=15&output=embed"
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
    </div>
    <p class="mb-0">Copyright &copy; 2026 - Todos los derechos reservados | Contacto: rivendell.plaza@gmail.com</p>
  </div>
</footer>