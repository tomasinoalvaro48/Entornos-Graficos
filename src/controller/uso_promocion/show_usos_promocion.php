<?php

require_once __DIR__ . "/../../data/UsoPromocionDAO.php";

function showUsosPromocion()
{
  $usoDAO = new UsoPromocionDAO();
  return $usoDAO->getAll();
}