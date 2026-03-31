<div
  class="modal fade"
  id="<?php echo htmlspecialchars($modalId, ENT_QUOTES, 'UTF-8'); ?>"
  tabindex="-1"
  aria-labelledby="<?php echo htmlspecialchars($modalId, ENT_QUOTES, 'UTF-8'); ?>Label"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="<?php echo htmlspecialchars($modalId, ENT_QUOTES, 'UTF-8'); ?>Label">Editar Local</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/src/controller/local/handle_update_local.php" method="POST">
        <div class="modal-body text-start">
          <input type="hidden" name="id_local" value="<?php echo htmlspecialchars($localToEdit->idLocal, ENT_QUOTES, 'UTF-8'); ?>">

          <div class="mb-3">
            <label for="nombre_local_<?php echo htmlspecialchars($localToEdit->idLocal, ENT_QUOTES, 'UTF-8'); ?>" class="form-label">Nombre del Local</label>
            <input
              type="text"
              class="form-control"
              id="nombre_local_<?php echo htmlspecialchars($localToEdit->idLocal, ENT_QUOTES, 'UTF-8'); ?>"
              name="nombre_local"
              value="<?php echo htmlspecialchars($localToEdit->nombreLocal, ENT_QUOTES, 'UTF-8'); ?>"
              required>
          </div>

          <div class="mb-3">
            <label for="ubicacion_local" class="form-label">Ubicación del Local</label>
            <input
              type="text"
              class="form-control"
              id="ubicacion_local"
              name="ubicacion_local"
              value="<?php echo htmlspecialchars($localToEdit->ubiLocal, ENT_QUOTES, 'UTF-8'); ?>"
              required>
          </div>

          <div class="mb-3">
            <label for="rubro_local" class="form-label">Rubro del Local</label>
            <input
              type="text"
              class="form-control"
              id="rubro_local"
              name="rubro_local"
              value="<?php echo htmlspecialchars($localToEdit->rubroLocal, ENT_QUOTES, 'UTF-8'); ?>"
              required>
          </div>

          <div class="mb-3">
            <label for="dueno_local" class="form-label">Dueño del Local</label>
            <select
              class="form-control"
              id="dueno_local"
              name="dueno_local"
              required>
              <option value="">Seleccionar un dueño</option>
              <?php foreach ($duenos as $d) { ?>
                <option
                  value="<?php echo htmlspecialchars($d->idUsuario, ENT_QUOTES, 'UTF-8'); ?>"
                  <?php echo $d->idUsuario === $localToEdit->usuario->idUsuario ? 'selected' : ''; ?>>
                  <?php echo htmlspecialchars($d->nombreUsuario, ENT_QUOTES, 'UTF-8'); ?>
                </option>
              <?php } ?>
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