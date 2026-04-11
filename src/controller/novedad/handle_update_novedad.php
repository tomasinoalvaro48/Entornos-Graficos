<?php

require_once __DIR__ . "/../auth.php";
require_once __DIR__ . "/../../data/NovedadDAO.php";
require_once __DIR__ . "/../../model/Novedad.php";


if (isset($_POST['botonActualizar'])) {
  $novedadDAO = new NovedadDAO();

  $textoNovedad = $_POST['texto_novedad'];
  $fechaDesdeNovedad = !empty($_POST['fecha_desde_novedad'])
    ? DateTime::createFromFormat('Y-m-d', $_POST['fecha_desde_novedad'])
    : null;
  $fechaHastaNovedad = !empty($_POST['fecha_hasta_novedad'])
    ? DateTime::createFromFormat('Y-m-d', $_POST['fecha_hasta_novedad'])
    : null;
  $tipoCliente = $_POST['tipo_cliente'];


  $novedadDAO->update(new Novedad(
    $_GET['id_novedad'],
    $textoNovedad,
    $fechaDesdeNovedad,
    $fechaHastaNovedad,
    $tipoCliente
  ));
  setSessionSuccess("Novedad actualizada exitosamente");
  header("Location: /src/view/pages/novedad/novedad_list.php");
};
