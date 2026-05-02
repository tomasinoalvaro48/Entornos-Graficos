<?php
require_once __DIR__ . "/../../data/UsoPromocionDAO.php";
require_once __DIR__ . "/../auth.php";

function getUsosCliente()
{
  $usuario = getUsuarioLogueado();
  $idCli = $usuario['id_usuario'];

  $usoDAO = new UsoPromocionDAO();
  return $usoDAO->getByCliente($idCli);
}

function getUsosClienteFiltered($fechaDesde = null, $fechaHasta = null, $estado = null, $local = null)
{
  $usuario = getUsuarioLogueado();
  $idCli = $usuario['id_usuario'];

  $usoDAO = new UsoPromocionDAO();
  return $usoDAO->getFilterByCliente($idCli, $fechaDesde, $fechaHasta, $estado, $local);
}

function handleUsosClienteList()
{
  $fechaDesde = null;
  $fechaHasta = null;
  $estado = null;
  $local = null;

  if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['botonFiltrarUsos'])) {
    $fechaDesde = !empty($_POST['fecha_desde_uso']) ? $_POST['fecha_desde_uso'] : null;
    $fechaHasta = !empty($_POST['fecha_hasta_uso']) ? $_POST['fecha_hasta_uso'] : null;
    $estado = !empty($_POST['estado_uso']) ? $_POST['estado_uso'] : null;
    $local = !empty($_POST['local']) ? $_POST['local'] : null;

    return getUsosClienteFiltered($fechaDesde, $fechaHasta, $estado, $local);
  }

  return getUsosCliente();
}