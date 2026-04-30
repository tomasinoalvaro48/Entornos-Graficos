<?php
require_once __DIR__ . "/../../data/UsuarioDAO.php";
require_once __DIR__ . "/../../enums.php";

function showDuenos()
{
  $usuarioDAO = new UsuarioDAO();
  return $usuarioDAO->getAllDuenos();
}

function showDuenosFiltered($nombre = null, $estado = null)
{
  $usuarioDAO = new UsuarioDAO();
  return $usuarioDAO->getFilterDuenos($nombre, $estado);
}

function handleDuenosList()
{
  $nombre = null;
  $estado = null;

  if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['botonFiltrarDuenos'])) {
    $nombre = !empty($_POST['nombre_dueno']) ? $_POST['nombre_dueno'] : null;
    $estado = !empty($_POST['estado_dueno']) ? $_POST['estado_dueno'] : null;
  }

  if ($estado === null && isset($_GET['estado']) && $_GET['estado'] !== '') {
    $estado = $_GET['estado'];
  }

  return showDuenosFiltered($nombre, $estado);
}
