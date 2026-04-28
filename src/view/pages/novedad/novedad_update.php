<?php $today = new DateTime(); ?>

<div
  class="modal fade"
  id="<?php echo htmlspecialchars($modalId, ENT_QUOTES, 'UTF-8'); ?>"
  tabindex="-1"
  aria-labelledby="<?php echo htmlspecialchars($modalId, ENT_QUOTES, 'UTF-8') ?>Label"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content c-card m-0" style="max-width: 100%;">
      <div class="modal-header border-0 pb-0 px-0">
        <h1 class="c-title modal-title">Editar Novedad</h1>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?php echo app_path('src/controller/novedad/handle_update_novedad.php'); ?>?id_novedad=<?php echo htmlspecialchars($novedadToEdit->codNovedad, ENT_QUOTES, 'UTF-8') ?>" method="POST" class="c-form-layout px-0 pt-3">
        <div class="modal-body text-start border-0 px-0">
          <input type="hidden" name="id_novedad" value="<?php echo htmlspecialchars($novedadToEdit->codNovedad, ENT_QUOTES, 'UTF-8'); ?>">

          <div class="c-form-field mb-3">
            <input
              type="text"
              class="c-form-input"
              id="texto_novedad_<?php echo $novedadToEdit->codNovedad; ?>"
              name="texto_novedad"
              value="<?php echo htmlspecialchars($novedadToEdit->textoNovedad, ENT_QUOTES, 'UTF-8'); ?>"
              placeholder=" "
              maxlength="255"
              required>
            <label for="texto_novedad_<?php echo $novedadToEdit->codNovedad; ?>" class="c-form-label">Nombre del local</label>
          </div>

          <div class="row mb-3">
            <div class="col-6">
              <div class="c-form-field">
                <input
                  type="date"
                  class="c-form-input c-form-input-date"
                  id="fecha_desde_novedad_<?php echo $novedadToEdit->codNovedad; ?>"
                  name="fecha_desde_novedad"
                  min="<?php echo $today->format('Y-m-d'); ?>"
                  value="<?php echo htmlspecialchars($novedadToEdit->fechaDesdeNovedad->format('Y-m-d'), ENT_QUOTES, 'UTF-8'); ?>"
                  placeholder=" "
                  required>
                <label for="fecha_desde_novedad_<?php echo $novedadToEdit->codNovedad; ?>" class="c-form-label">Fecha Desde</label>
              </div>
            </div>
            <div class="col-6">
              <div class="c-form-field">
                <input
                  type="date"
                  class="c-form-input c-form-input-date"
                  id="fecha_hasta_novedad_<?php echo $novedadToEdit->codNovedad; ?>"
                  name="fecha_hasta_novedad"
                  min="<?php echo $today->format('Y-m-d'); ?>"
                  value="<?php echo htmlspecialchars($novedadToEdit->fechaHastaNovedad->format('Y-m-d'), ENT_QUOTES, 'UTF-8'); ?>"
                  placeholder=" "
                  required>
                <label for="fecha_hasta_novedad_<?php echo $novedadToEdit->codNovedad; ?>" class="c-form-label">Fecha Hasta</label>
              </div>
            </div>
          </div>

          <div class="c-form-field mb-3">
            <select class="c-form-input c-form-input-select" id="categoria_cliente_<?php echo $novedadToEdit->codNovedad; ?>" name="categoria_cliente" required>
              <option value="">Seleccione una Categoría de Cliente</option>
              <option value="inicial" <?php echo ($novedadToEdit->categoriaCliente === 'inicial') ? 'selected' : ''; ?>>Inicial</option>
              <option value="medium" <?php echo ($novedadToEdit->categoriaCliente === 'medium') ? 'selected' : ''; ?>>Medium</option>
              <option value="premium" <?php echo ($novedadToEdit->categoriaCliente === 'premium') ? 'selected' : ''; ?>>Premium</option>
            </select>
            <label for="categoria_cliente_<?php echo $novedadToEdit->codNovedad; ?>" class="c-form-label">Categoría de Cliente</label>
          </div>

        </div>
        <div class="modal-footer border-0 px-0">
          <button type="submit" class="c-btn-primary m-0 mb-2" name="botonActualizar" id="botonActualizar">Actualizar</button>
          <button type="button" class="c-btn-secondary-ghost m-0" data-bs-dismiss="modal">Cancelar</button>
        </div>

      </form>

    </div>


  </div>




</div>
<script>
  <?php include_once __DIR__ . "/fecha_validator.js"; ?>
</script>