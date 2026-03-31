<?php
require_once __DIR__ . "/../../data/LocalDAO.php";

function showLocales()
{
  $localDAO = new LocalDAO();
  return $localDAO->getAll();
}

function showLocalById($id)
{
  $localDAO = new LocalDAO();
  return $localDAO->getById($id);
}
