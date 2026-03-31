<?php
require_once __DIR__ . "/../../data/UsuarioDAO.php";

function showDuenos()
{
  $usuarioDAO = new UsuarioDAO();
  return $usuarioDAO->getAllDuenos();
}
