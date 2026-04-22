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