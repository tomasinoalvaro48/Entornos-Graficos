<?php
require_once __DIR__ . "/../../data/LocalDAO.php";
require_once __DIR__ . "/../../enums.php";
require_once __DIR__ . "/../auth.php";

function showLocales()
{
  $localDAO = new LocalDAO();
  return $localDAO->getAll();
}

function showLocalesFiltered($nombre = null, $rubro = null, $estado = null, $idUsuario = null)
{
  $localDAO = new LocalDAO();
  return $locales = $localDAO->getFilter($nombre, $rubro, $estado, $idUsuario);
}

function handleLocalesList()
{
  $tipo = getTipoUsuario();
  $usuario = getUsuarioLogueado();
  $idUsuario = $usuario['id_usuario'] ?? null;

  $nombre = null;
  $rubro = null;
  $estado = null;

  if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['botonFiltrarLocales'])) {
    $nombre = !empty($_POST['nombre_local']) ? $_POST['nombre_local'] : null;
    $rubro = !empty($_POST['rubro_local']) ? $_POST['rubro_local'] : null;

    if ($tipo === TipoUsuario::ADMIN->value || $tipo === TipoUsuario::DUENO->value) {
      $estado = !empty($_POST['estado_elim_local']) ? $_POST['estado_elim_local'] : null;
    } else {
      $estado = EstadoLocal::ACTIVO->value; // Para clientes, solo mostrar locales activos
    }
  }

  if ($tipo === TipoUsuario::DUENO->value) {
    return showLocalesFiltered($nombre, $rubro, $estado, $idUsuario);
  }

  return showLocalesFiltered($nombre, $rubro, $estado);
}

function showLocalById($id)
{
  $localDAO = new LocalDAO();
  return $localDAO->getById($id);
}