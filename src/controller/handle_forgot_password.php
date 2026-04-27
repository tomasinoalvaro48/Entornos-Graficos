<?php
require_once __DIR__ . "/../data/UsuarioDAO.php";
require_once __DIR__ . "/auth.php";
require_once __DIR__ . "/send_reset_password_email.php";

$usuarioDAO = new UsuarioDAO();

if (isset($_POST['email'])) {
  $email = $_POST['email'];

  $usuario = $usuarioDAO->getByEmail($email);

  if (!$usuario) {
    setSessionError("No existe un usuario con ese mail.");
    header("Location: " . app_path('src/view/pages/auth/forgot_password.php'));
    exit();
  }

  $token = bin2hex(random_bytes(16));

  $usuarioDAO->updateToken($usuario->idUsuario, $token);

  // Validar que el email sea válido antes de enviar (según norma rfc822: https://datatracker.ietf.org/doc/html/rfc822)
  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $mailSent = sendResetPasswordEmail($email, $token, $usuario->nombreUsuario);

    if (!$mailSent) {
      setSessionError("Error al enviar el mail.");
    } else {
      setSessionSuccess("Se envió un link de recuperación a tu mail.");
    }
  } else {
    setSessionError("El email del usuario es inválido.");
  }

  header("Location: " . app_path('src/view/pages/auth/login.php'));
  exit();
}
