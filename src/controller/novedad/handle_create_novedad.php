<?php

require_once __DIR__ . "/../auth.php";
require_once __DIR__ . "/../../data/NovedadDAO.php";
require_once __DIR__ . "/../../model/Novedad.php";

if (isset($_POST['botonCrearNovedad'])) {
  $novedadDAO = new NovedadDAO();
  $textoNovedad = $_POST['texto_novedad'];
  $fechaDesdeNovedad = !empty($_POST['fecha_desde_novedad'])
    ? DateTime::createFromFormat('Y-m-d', $_POST['fecha_desde_novedad'])
    : null;
  $fechaHastaNovedad = !empty($_POST['fecha_hasta_novedad'])
    ? DateTime::createFromFormat('Y-m-d', $_POST['fecha_hasta_novedad'])
    : null;
  $tipoUsuario = $_POST['tipo_usuario'];

  if ($_POST['fecha_desde_novedad'] !== '' && !$fechaDesdeNovedad) {
    setSessionError("La fecha desde no es valida.");
    header("Location: /src/view/pages/novedad/novedad_create.php");
  }

  if ($_POST['fecha_hasta_novedad'] !== '' && !$fechaHastaNovedad) {
    setSessionError("La fecha hasta no es valida.");
    header("Location: /src/view/pages/novedad/novedad_create.php");
  }

  $novedadDAO->create(new Novedad(
    null,
    $textoNovedad,
    $fechaDesdeNovedad,
    $fechaHastaNovedad,
    $tipoUsuario
  ));
  setSessionSuccess("Novedad creada exitosamente.");
  header("Location: /src/view/pages/novedad/novedad_list.php");
}
