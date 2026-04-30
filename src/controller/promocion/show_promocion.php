<?php
require_once __DIR__ . "/../../data/PromocionDAO.php";

function showPromociones()
{
  $promocionDAO = new PromocionDAO();
  return $promocionDAO->getAll();
}

function showPromocionesFiltered($fechaDesde = null, $fechaHasta = null, $categoriaCliente = null, $estado = null, $local = null, $dia = null)
{
  $promocionDAO = new PromocionDAO();
  return $promocionDAO->getFilter($fechaDesde, $fechaHasta, $categoriaCliente, $estado, $local, $dia);
}

function handlePromocionesList()
{
  $tipo = getTipoUsuario();

  $fechaDesde = null;
  $fechaHasta = null;
  $categoria = null;
  $estado = null;
  $local = null;
  $dia = null;

  $promocionDAO = new PromocionDAO();

  //GET (cliente)
  if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['id_local'])) {
    $idLocal = $_GET['id_local'];

    $usuario = getUsuarioLogueado();
    $categoriaCliente = $usuario['categoria_cliente'] ?? null;

    return $promocionDAO->getPromosValidasParaCliente($idLocal, $categoriaCliente);
  }

  //POST (filtros)
  if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['botonFiltrarPromociones'])) {
    $fechaDesde = !empty($_POST['fecha_desde_promocion']) ? $_POST['fecha_desde_promocion'] : null;
    $fechaHasta = !empty($_POST['fecha_hasta_promocion']) ? $_POST['fecha_hasta_promocion'] : null;
    $categoria = !empty($_POST['categoria_cliente']) ? $_POST['categoria_cliente'] : null;
    $local = !empty($_POST['local']) ? $_POST['local'] : null;
    $dia = !empty($_POST['dia']) ? $_POST['dia'] : null;

    if ($tipo === TipoUsuario::DUENO->value) {
      $categoria = !empty($_POST['categoria_cliente']) ? $_POST['categoria_cliente'] : null;
      $estado = !empty($_POST['estado_promocion']) ? $_POST['estado_promocion'] : null;
    }
  }

  if ($tipo === TipoUsuario::CLIENTE->value) {
    $usuario = getUsuarioLogueado();
    $categoria = $usuario['categoria_cliente'] ?? null;

    $estado = 'aprobada';
  }

  return showPromocionesFiltered($fechaDesde, $fechaHasta, $categoria, $estado, $local, $dia);
}