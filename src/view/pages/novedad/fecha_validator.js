const fechaDesdeInput = document.getElementById('fecha_desde_novedad');
const fechaHastaInput = document.getElementById('fecha_hasta_novedad');

function syncFechaHastaMin() {
  const fechaDesde = fechaDesdeInput.value;
  if (fechaDesde) {
    fechaHastaInput.min = fechaDesde;
    if (fechaHastaInput.value && fechaHastaInput.value < fechaDesde) {
      fechaHastaInput.value = fechaDesde;
    }
  }
}

syncFechaHastaMin();
fechaDesdeInput.addEventListener('change', syncFechaHastaMin);
