<?php
require_once __DIR__ . "/../../data/UsuarioDAO.php";
require_once __DIR__ . "/../auth.php";

if (isset($_POST['botonSolicitar'])) {
  $udao = new UsuarioDAO();

  // Verificar si el correo electrónico ya está registrado
  $usuario = $udao->getByEmail($_POST['email_usuario']);
  if ($usuario) {
    setSessionError("Este usuario ya existe. Por favor, intente con otro correo electrónico o inicie sesión.");
    header("Location: /src/view/pages/signin.php");
    exit();
  }

  // Verificar que las contraseñas coincidan
  if ($_POST['clave_usuario'] !== $_POST['clave_usuario_conf']) {
    setSessionError("Las contraseñas no coinciden. Por favor, intente nuevamente.");
    header("Location: /src/view/pages/signin.php");
    exit();
  }

  // Crear el nuevo usuario con estado 'pendiente' para revisión
  $udao->create(new Usuario(
    null,
    $_POST['nombre_usuario'],
    $_POST['email_usuario'],
    $_POST['clave_usuario'],
    'cliente',
    'inicial'
  ));
  setSessionSuccess("Usuario creado exitosamente. Por favor, inicie sesión.");
  header("Location: /src/view/pages/login.php");
}
