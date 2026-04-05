<?php
require_once __DIR__ .'/../../data/NovedadDAO.php';

function showNovedades()
{
  $novedadDAO = new NovedadDAO();
  return $novedadDAO->getAll();
}