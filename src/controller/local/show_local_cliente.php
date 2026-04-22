<?php
require_once __DIR__ . "/../../data/LocalDAO.php";

function getLocalesCliente($rubro = null)
{
  $localDAO = new LocalDAO();

  if ($rubro) {
    return $localDAO->getByRubro($rubro);
  }

  return $localDAO->getAll();
}