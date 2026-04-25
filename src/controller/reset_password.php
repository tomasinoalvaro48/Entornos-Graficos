<?php
require_once __DIR__ . "/../data/UsuarioDAO.php";
require_once __DIR__ . "/auth.php";

if (isset($_GET['mail']) && isset($_GET['token'])) {
  $usuarioDAO = new UsuarioDAO();
  $usuario = $usuarioDAO->getByEmail($_GET['mail']);

  if ($usuario && $usuario->tokenVerificacion === $_GET['token']) {
    $_SESSION['reset_user'] = $usuario->idUsuario;

    header("Location: " . app_path('src/view/pages/auth/new_password.php') . 
      '?mail=' . urlencode($_GET['mail']) . 
      '&token=' . urlencode($_GET['token']));
    exit();
  }
}

setSessionError("Link inválido.");
header("Location: " . app_path('src/view/pages/auth/login.php'));