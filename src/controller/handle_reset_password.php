<?php
require_once __DIR__ . "/../data/UsuarioDAO.php";
require_once __DIR__ . "/auth.php";

if (!isset($_POST['mail']) || !isset($_POST['token'])) {
  setSessionError("Solicitud inválida.");
  header("Location: " . app_path('src/view/pages/auth/login.php'));
  exit();
}

if (isset($_POST['pass'], $_POST['pass2'])) {
  if ($_POST['pass'] !== $_POST['pass2']) {
    setSessionError("Las contraseñas no coinciden.");
    header("Location: " . app_path('src/view/pages/auth/new_password.php') .
      '?mail=' . urlencode($_POST['mail']) .
      '&token=' . urlencode($_POST['token']));
    exit();
  }

  $usuarioDAO = new UsuarioDAO();
  $usuario = $usuarioDAO->getByEmail($_POST['mail']);

  if (!$usuario || $usuario->tokenVerificacion !== $_POST['token']) {
    setSessionError("Token inválido.");
    header("Location: " . app_path('src/view/pages/auth/login.php'));
    exit();
  }

  $query = "UPDATE usuario 
            SET clave_usuario = '" . md5($_POST['pass']) . "', 
                token_verificacion = NULL
            WHERE id_usuario = '" . $usuario->idUsuario . "';";

  $result = $usuarioDAO->querySQL($query);

  if (!$result) {
    setSessionError("Error al actualizar la contraseña.");
    header("Location: " . app_path('src/view/pages/auth/new_password.php'));
    exit();
  }

  setSessionSuccess("Contraseña actualizada correctamente.");
  header("Location: " . app_path('src/view/pages/auth/login.php'));
  exit();
}