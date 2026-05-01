<?php
require_once __DIR__ . '/../../data/NovedadDAO.php';
require_once __DIR__ . '/../../enums.php';

// Mostrar todas las novedades sin filtros (para admins y dueños)
function showNovedades()
{
  $novedadDAO = new NovedadDAO();
  return $novedadDAO->getAll();
}

// Mostrar novedades filtradas por jerarquía de categoría de cliente (para clientes)
function showNovedadesByCategoriaCliente($categoriaCliente)
{
  $novedadDAO = new NovedadDAO();
  // Siempre mostramos cat INICIAL
  $novedades = $novedadDAO->getByCategoriaCliente(CategoriaCliente::INICIAL->value);
  // Si el cliente es REGULAR, también mostramos las novedades para REGULAR
  if ($categoriaCliente === CategoriaCliente::REGULAR->value) {
    $novedades = array_merge($novedades, $novedadDAO->getByCategoriaCliente(CategoriaCliente::REGULAR->value));
  }
  // Si el cliente es PREMIUM, también mostramos las novedades para REGULAR y PREMIUM
  if ($categoriaCliente === CategoriaCliente::PREMIUM->value) {
    $novedades = array_merge($novedades, $novedadDAO->getByCategoriaCliente(CategoriaCliente::REGULAR->value));
    $novedades = array_merge($novedades, $novedadDAO->getByCategoriaCliente(CategoriaCliente::PREMIUM->value));
  }
  return $novedades;
}

// Mostrar novedades filtradas por fechas y categoría de cliente (esto último solo para admins y dueños)
function showNovedadesFiltered(
  $fechaDesde = null,
  $fechaHasta = null,
  $categoriaClienteFiltro = null
) {
  $tipo = getTipoUsuario();
  $categoriaCliente = getCategoriaCliente();
  $novedadDAO = new NovedadDAO();
  if ($tipo === TipoUsuario::CLIENTE->value && $categoriaCliente) {
    // el cliente no puede filtrar por categoría, solo por fechas
    return $novedadDAO->getFilterCliente($fechaDesde, $fechaHasta, $categoriaCliente);
  }
  return $novedadDAO->getFilter($fechaDesde, $fechaHasta, $categoriaClienteFiltro);
}

// Controlador principal para mostrar la lista de novedades, con o sin filtros
function handleNovedadesList()
{
  $tipo = getTipoUsuario();
  $categoriaCliente = getCategoriaCliente();
  $fechaDesde = null;
  $fechaHasta = null;
  $filtroCategoria = null;

  if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['botonFiltrarNovedades'])) {
    $fechaDesde = !empty($_POST['fecha_desde_novedad']) ? $_POST['fecha_desde_novedad'] : null;
    $fechaHasta = !empty($_POST['fecha_hasta_novedad']) ? $_POST['fecha_hasta_novedad'] : null;
    // Solo los admins y dueños pueden filtrar por categoría de cliente
    if ($tipo === TipoUsuario::ADMIN->value || $tipo === TipoUsuario::DUENO->value) {
      $filtroCategoria = !empty($_POST['categoria_cliente']) ? $_POST['categoria_cliente'] : null;
    }
    return showNovedadesFiltered($fechaDesde, $fechaHasta, $filtroCategoria);
  }

  if ($tipo === TipoUsuario::CLIENTE->value) {
    return showNovedadesByCategoriaCliente($categoriaCliente);
  }

  return showNovedades();
}
