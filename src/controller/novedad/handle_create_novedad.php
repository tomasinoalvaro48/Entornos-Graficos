<?php

require_once __DIR__ . "/../auth.php";
require_once __DIR__ . "/../../data/NovedadDAO.php";
require_once __DIR__ . "/../../model/Novedad.php";

if (isset($_POST['botonCrearNovedad'])) {
  $novedadDAO = new NovedadDAO();
  $imagenNovedad = 'default_novedad.svg';

  if (isset($_FILES['imagen_novedad']) && $_FILES['imagen_novedad']['error'] === UPLOAD_ERR_OK && is_uploaded_file($_FILES['imagen_novedad']['tmp_name'])) {
    $uploadDir = __DIR__ . '/../../img/novedades/';
    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0777, true);
    }

    $nombreArchivo = basename($_FILES['imagen_novedad']['name']);
    $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));
    $permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];

    if (in_array($extension, $permitidas, true)) {
      $nombreFinal = 'novedad_' . time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', pathinfo($nombreArchivo, PATHINFO_FILENAME)) . '.' . $extension;
      $rutaDestino = $uploadDir . $nombreFinal;

      if (move_uploaded_file($_FILES['imagen_novedad']['tmp_name'], $rutaDestino)) {
        $imagenNovedad = $nombreFinal;
      }
    }
  }

  $textoNovedad = $_POST['texto_novedad'];
  $fechaDesdeNovedad = !empty($_POST['fecha_desde_novedad'])
    ? DateTime::createFromFormat('Y-m-d', $_POST['fecha_desde_novedad'])
    : null;
  $fechaHastaNovedad = !empty($_POST['fecha_hasta_novedad'])
    ? DateTime::createFromFormat('Y-m-d', $_POST['fecha_hasta_novedad'])
    : null;
  $categoriaCliente = $_POST['categoria_cliente'];

  require_once __DIR__ . "/validation_novedad.php";

  $novedadDAO->create(new Novedad(
    null,
    $textoNovedad,
    $fechaDesdeNovedad,
    $fechaHastaNovedad,
    $categoriaCliente,
    null,
    $imagenNovedad
  ));
  setSessionSuccess("Novedad creada exitosamente.");
  header("Location: " . app_path('src/view/pages/novedad/novedad_list.php'));
  exit;
}