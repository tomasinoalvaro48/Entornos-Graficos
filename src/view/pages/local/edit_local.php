<div
  class="modal fade"
  id="<?php echo htmlspecialchars($modalId, ENT_QUOTES, 'UTF-8'); ?>"
  tabindex="-1"
  aria-labelledby="<?php echo htmlspecialchars($modalId, ENT_QUOTES, 'UTF-8'); ?>Label"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content c-card m-0" style="max-width: 100%;">
      <div class="modal-header border-0 pb-0 px-0">
        <h1 class="c-title modal-title" id="<?php echo htmlspecialchars($modalId, ENT_QUOTES, 'UTF-8'); ?>Label">Editar Local</h1>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?php echo app_path('src/controller/local/handle_update_local.php'); ?>?id=<?php echo htmlspecialchars($localToEdit->idLocal, ENT_QUOTES, 'UTF-8') ?>" method="POST" class="c-form-layout px-0 pt-3">
        <div class="modal-body text-start border-0 px-0">
          <input type="hidden" name="id_local" value="<?php echo htmlspecialchars($localToEdit->idLocal, ENT_QUOTES, 'UTF-8'); ?>">

          <div class="c-form-field mb-3">
            <input
              type="text"
              class="c-form-input"
              id="nombre_local_<?php echo htmlspecialchars($localToEdit->idLocal, ENT_QUOTES, 'UTF-8'); ?>"
              name="nombre_local"
              value="<?php echo htmlspecialchars($localToEdit->nombreLocal, ENT_QUOTES, 'UTF-8'); ?>"
              placeholder=" "
              required>
            <label for="nombre_local_<?php echo htmlspecialchars($localToEdit->idLocal, ENT_QUOTES, 'UTF-8'); ?>" class="c-form-label">Nombre del Local</label>
          </div>

          <div class="c-form-field mb-3">
            <input
              type="text"
              class="c-form-input"
              id="ubicacion_local_<?php echo htmlspecialchars($localToEdit->idLocal, ENT_QUOTES, 'UTF-8'); ?>"
              name="ubicacion_local"
              value="<?php echo htmlspecialchars($localToEdit->ubiLocal, ENT_QUOTES, 'UTF-8'); ?>"
              placeholder=" "
              required>
            <label for="ubicacion_local_<?php echo htmlspecialchars($localToEdit->idLocal, ENT_QUOTES, 'UTF-8'); ?>" class="c-form-label">Ubicación del Local</label>
          </div>

          <div class="c-form-field mb-3">
            <input
              type="text"
              class="c-form-input"
              id="rubro_local_<?php echo htmlspecialchars($localToEdit->idLocal, ENT_QUOTES, 'UTF-8'); ?>"
              name="rubro_local"
              value="<?php echo htmlspecialchars($localToEdit->rubroLocal, ENT_QUOTES, 'UTF-8'); ?>"
              placeholder=" "
              required>
            <label for="rubro_local_<?php echo htmlspecialchars($localToEdit->idLocal, ENT_QUOTES, 'UTF-8'); ?>" class="c-form-label">Rubro del Local</label>
          </div>

          <div class="c-form-field mb-3">
            <select
              class="c-form-input c-form-input-select"
              id="dueno_local_<?php echo htmlspecialchars($localToEdit->idLocal, ENT_QUOTES, 'UTF-8'); ?>"
              name="dueno_local"
              required>
              <option value="">Seleccionar un dueño</option>
              <?php foreach ($duenos as $d) { ?>
                <?php if ($d->estadoDueno !== 'pendiente') { ?>
                  <option
                    value="<?php echo htmlspecialchars($d->idUsuario, ENT_QUOTES, 'UTF-8'); ?>"
                    <?php echo $d->idUsuario === $localToEdit->usuario->idUsuario ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($d->nombreUsuario, ENT_QUOTES, 'UTF-8'); ?>
                  </option>
              <?php }
              } ?>
            </select>
            <label for="dueno_local_<?php echo htmlspecialchars($localToEdit->idLocal, ENT_QUOTES, 'UTF-8'); ?>" class="c-form-label">Dueño del Local</label>
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