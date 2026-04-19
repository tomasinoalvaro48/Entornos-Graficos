<?php $today = new DateTime(); ?>

<div
  class="modal fade"
  id="<?php echo htmlspecialchars($modalId, ENT_QUOTES, 'UTF-8'); ?>"
  tabindex="-1"
  aria-labelledby="<?php echo htmlspecialchars($modalId, ENT_QUOTES, 'UTF-8') ?>Label"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Editar Novedad</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?php echo app_path('src/controller/novedad/handle_update_novedad.php'); ?>?id_novedad=<?php echo htmlspecialchars($novedadToEdit->codNovedad, ENT_QUOTES, 'UTF-8') ?>" method="POST">
        <div class="modal-body text-start">
          <input type="hidden" name="id_novedad" value="<?php echo htmlspecialchars($novedadToEdit->codNovedad, ENT_QUOTES, 'UTF-8'); ?>">
          <div class="mb-3">
            <label for="texto_novedad" class="form-label">Nombre del local</label>
            <input
              type="text"
              class="form-control"
              id="texto_novedad"
              name="texto_novedad"
              value="<?php echo htmlspecialchars($novedadToEdit->textoNovedad, ENT_QUOTES, 'UTF-8'); ?>"
              maxlength="255"
              required>
          </div>

          <div class="mb-3">
            <label for="texto_novedad" class="form-label">Fecha Desde</label>
            <input
              type="date"
              class="form-control"
              id="fecha_desde_novedad"
              name="fecha_desde_novedad"
              min="<?php echo $today->format('Y-m-d'); ?>"
              value="<?php echo htmlspecialchars($novedadToEdit->fechaDesdeNovedad->format('Y-m-d'), ENT_QUOTES, 'UTF-8'); ?>"
              required>
          </div>
          <div class="mb-3">
            <label for=" texto_novedad" class="form-label">Fecha Hasta</label>
            <input
              type="date"
              class="form-control"
              id="fecha_hasta_novedad"
              name="fecha_hasta_novedad"
              min="<?php echo $today->format('Y-m-d'); ?>"
              value="<?php echo htmlspecialchars($novedadToEdit->fechaHastaNovedad->format('Y-m-d'), ENT_QUOTES, 'UTF-8'); ?>"
              required>
          </div>
          <div class="mb-3">
            <label for=" texto_novedad" class="form-label">Descripción de la Novedad</label>
            <select class='form-control' id='categoria_cliente' name="categoria_cliente" required>
              <option value="">Seleccione una Categoría de Cliente</option>
              <option value="inicial" <?php echo ($novedadToEdit->categoriaCliente === 'inicial') ? 'selected' : ''; ?>>Inicial</option>
              <option value="medium" <?php echo ($novedadToEdit->categoriaCliente === 'medium') ? 'selected' : ''; ?>>Medium</option>
              <option value="premium" <?php echo ($novedadToEdit->categoriaCliente === 'premium') ? 'selected' : ''; ?>>Premium</option>
            </select>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary" name="botonActualizar" id="botonActualizar">Actualizar</button>
        </div>

      </form>

    </div>


  </div>




</div>
<script>
  <?php include_once __DIR__ . "/fecha_validator.js"; ?>
</script>