<?php
// Validaciones
// Fechas no pueden ser anteriores a hoy, y fecha hasta no puede ser anterior a fecha desde
$hoy = new DateTime('today');

if ($_POST['fecha_desde_novedad'] !== '' && (!$fechaDesdeNovedad || $fechaDesdeNovedad < $hoy)) {
  setSessionError("La fecha desde no es valida.");
  header("Location: " . app_path('src/view/pages/novedad/novedad_create.php'));
  exit;
}

if ($_POST['fecha_hasta_novedad'] !== '' && (!$fechaHastaNovedad || ($fechaDesdeNovedad && $fechaHastaNovedad < $fechaDesdeNovedad))) {
  setSessionError("La fecha hasta no es valida.");
  header("Location: " . app_path('src/view/pages/novedad/novedad_create.php'));
  exit;
}

//Validacion que texto novedad no supere los 255 caracteres
if (strlen($textoNovedad) > 255) {
  setSessionError("La descripción de la novedad no puede superar los 255 caracteres.");
  header("Location: " . app_path('src/view/pages/novedad/novedad_create.php'));
  exit;
}
