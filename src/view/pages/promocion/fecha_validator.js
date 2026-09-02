document.querySelectorAll('input[id^="fecha_desde"]').forEach(fechaDesdeInput => {
  const baseId = fechaDesdeInput.id;
  const suffix = baseId.substring('fecha_desde'.length);
  const fechaHastaInput = document.getElementById('fecha_hasta' + suffix);

  if (fechaHastaInput) {
    function syncFechaHastaMin() {
      const fechaDesde = fechaDesdeInput.value;
      if (fechaDesde) {
        fechaHastaInput.min = fechaDesde;
        if (fechaHastaInput.value && fechaHastaInput.value < fechaDesde) {
          fechaHastaInput.value = fechaDesde;
        }
      } else {
        const today = new Date().toISOString().split('T')[0];
        fechaHastaInput.min = today;
      }
    }

    syncFechaHastaMin();
    fechaDesdeInput.addEventListener('change', syncFechaHastaMin);
  }
});