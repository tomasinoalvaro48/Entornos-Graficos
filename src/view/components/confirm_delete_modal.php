<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <p id="confirmDeleteModalMessage">¿Estás seguro de que queres eliminar este elemento?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="c-btn-secondary-tonal" data-bs-dismiss="modal">Cancelar</button>
        <a href="#" id="confirmDeleteBtn" class="c-btn-danger-tonal" style="text-decoration: none;">Eliminar</a>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const deleteTriggers = document.querySelectorAll('.btn-delete-trigger');
    
    if(deleteTriggers.length > 0) {
      const confirmDeleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
      const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
      const confirmDeleteModalMessage = document.getElementById('confirmDeleteModalMessage');

      deleteTriggers.forEach(function(trigger) {
        trigger.addEventListener('click', function(e) {
          e.preventDefault();
          
          const deleteUrl = this.getAttribute('href');
          confirmDeleteBtn.setAttribute('href', deleteUrl);

          const customMessage = this.getAttribute('data-delete-msg');
          if (customMessage) {
            confirmDeleteModalMessage.textContent = customMessage;
          } else {
            confirmDeleteModalMessage.textContent = '¿Estás seguro de que queres eliminar este elemento?';
          }

          confirmDeleteModal.show();
        });
      });
    }
  });
</script>