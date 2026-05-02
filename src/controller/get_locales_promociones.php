<?php
require_once __DIR__ . "/auth.php";
require_once __DIR__ . "/../data/LocalDAO.php";

function getLocalesPromociones()
{
  $busqueda = isset($_GET['busqueda']) ? trim($_GET['busqueda']) : '';

  if ($busqueda === '') {
    return [];
  }

  $localDAO = new LocalDAO();
  return $localDAO->searchLocalesPromocionesByName(strtolower($busqueda));
}
