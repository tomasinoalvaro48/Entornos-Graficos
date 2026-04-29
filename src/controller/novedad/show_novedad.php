<?php
require_once __DIR__ . '/../../data/NovedadDAO.php';
require_once __DIR__ . '/../../enums.php';

function showNovedades()
{
  $novedadDAO = new NovedadDAO();
  return $novedadDAO->getAll();
}


function showNovedadesByClientType($categoriaCliente)
{
  $novedadDAO = new NovedadDAO();
  return $novedadDAO->getByClientType($categoriaCliente);
}


function showNovedadesFiltered($fechaDesde = null, $fechaHasta = null, $categoriaCliente = null)
{
  $novedadDAO = new NovedadDAO();
  return $novedades = $novedadDAO->getFilter($fechaDesde, $fechaHasta, $categoriaCliente);
}

function handleNovedadesList()
{
  $tipo = getTipoUsuario();
  $fechaDesde = null;
  $fechaHasta = null;
  $filtroCategoria = null;

  if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['botonFiltrarNovedades'])) {
    $fechaDesde = !empty($_POST['fecha_desde_novedad']) ? $_POST['fecha_desde_novedad'] : null;
    $fechaHasta = !empty($_POST['fecha_hasta_novedad']) ? $_POST['fecha_hasta_novedad'] : null;
    if ($tipo === TipoUsuario::ADMIN->value) {
      $filtroCategoria = !empty($_POST['categoria_cliente']) ? $_POST['categoria_cliente'] : null;
    }
  }

  if ($tipo === TipoUsuario::CLIENTE->value) {
    $categoriaCliente = getCategoriaCliente();
    return showNovedadesFiltered($fechaDesde, $fechaHasta, $categoriaCliente);
  } else {
    return showNovedadesFiltered($fechaDesde, $fechaHasta, $filtroCategoria);
  }
}

