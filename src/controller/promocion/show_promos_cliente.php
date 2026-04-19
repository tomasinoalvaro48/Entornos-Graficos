<?php
require_once __DIR__ . "/../../data/PromocionDAO.php";
require_once __DIR__ . "/../auth.php";

function getPromosCliente($idLocal)
{
  $usuario = getUsuarioLogueado();
  $categoria = $usuario['categoria_cliente'];

  $promocionDAO = new PromocionDAO();
  return $promocionDAO->getPromosValidasParaCliente($idLocal, $categoria);
}