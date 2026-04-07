<?php
require_once __DIR__ . "/../../data/UsuarioDAO.php";
require_once __DIR__ . "/../auth.php";

if (isset($_POST['botonSolicitar'])) {
  $udao = new UsuarioDAO();

  // Verificar si el correo electrónico ya está registrado
  $usuario = $udao->getByEmail($_POST['email_dueno']);
  if ($usuario) {
    setSessionError("Este usuario ya existe. Por favor, intente con otro correo electrónico o inicie sesión.");
    header("Location: /src/view/pages/auth/signin_dueno.php");
    exit();
  }

  // Verificar que las contraseñas coincidan
  if ($_POST['clave_dueno'] !== $_POST['clave_dueno_conf']) {
    setSessionError("Las contraseñas no coinciden. Por favor, intente nuevamente.");
    header("Location: /src/view/pages/auth/signin_dueno.php");
    exit();
  }

  // Crear el nuevo DUEÑO con estado 'pendiente'
  $udao->create(new Usuario(
    null,
    $_POST['nombre_dueno'],
    $_POST['email_dueno'],
    $_POST['clave_dueno'],
    'dueno',
    null,
    'pendiente'
  ));
  setSessionSuccess("Solicitud de registro enviada exitosamente. Le avisaremos a su mail cuando su cuenta sea aprobada por un administrador.");
  header("Location: /src/view/pages/auth/login.php");
  exit();
}
