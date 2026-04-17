<?php
include_once __DIR__ . "/../data/UsuarioDAO.php";
include_once __DIR__ . "/auth.php";

if (isset($_GET['mail']) && isset($_GET['token'])) {
  $email = $_GET['mail'];
  $token = $_GET['token'];

  $udao = new UsuarioDAO();
  $usuario = $udao->getByEmail($email);

  // Verificar que el usuario exista, que el token coincida y que el estado del mail sea 'no_confirmado'
  if ($usuario && $usuario->estadoMail === 'no_confirmado' && $usuario->tokenVerificacion === $token) {
    $usuario->estadoMail = 'confirmado';
    $udao->updateEstadoMail($usuario->idUsuario, $usuario->estadoMail);

    if ($usuario->tipoUsuario === 'dueno') {
      setSessionSuccess("Correo verificado exitosamente. Le avisaremos a su mail cuando su cuenta sea aprobada por un administrador.");
    } else {
      setSessionSuccess("Correo verificado exitosamente. Ya puede iniciar sesión.");
    }
    header("Location: /src/view/pages/auth/login.php");
  } else {
    setSessionError("No se encontró un usuario con ese correo electrónico. Por favor, intente nuevamente.");
    header("Location: /src/view/pages/auth/signin.php");
  }
} else {
  setSessionError("No se proporcionó un correo electrónico para verificar. Por favor, intente nuevamente.");
  header("Location: /src/view/pages/auth/signin.php");
}
