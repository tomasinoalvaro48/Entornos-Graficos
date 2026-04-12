<?php
require_once __DIR__ . "/../../data/PromocionDAO.php";

function showPromociones()
{
  $promocionDAO = new PromocionDAO();
  return $promocionDAO->getAll();
}