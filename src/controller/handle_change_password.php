<?php
require_once __DIR__ . "/../data/UsuarioDAO.php";
require_once __DIR__ . "/auth.php";

ensureSessionActive();

$usuarioLogueado = getUsuarioLogueado();

if (!$usuarioLogueado['id_usuario']) {
  setSessionError("Tenés que iniciar sesión.");
  header("Location: " . app_path('src/view/pages/auth/login.php'));
  exit();
}

if (!isset($_POST['pass_actual'], $_POST['pass_nueva'], $_POST['pass_repetir'])) {
  setSessionError("Datos incompletos.");
  header("Location: " . app_path('src/view/pages/auth/change_password.php'));
  exit();
}

$passActual = $_POST['pass_actual'];
$passNueva = $_POST['pass_nueva'];
$passRepetir = $_POST['pass_repetir'];

if ($passNueva !== $passRepetir) {
  setSessionError("Las contraseñas nuevas no coinciden.");
  header("Location: " . app_path('src/view/pages/auth/change_password.php'));
  exit();
}

if (strlen($passNueva) < 8 || !preg_match('/[A-Z]/', $passNueva) || !preg_match('/[0-9]/', $passNueva)) {
  setSessionError("La nueva contraseña debe tener al menos 8 caracteres, una mayúscula y un número.");
  header("Location: " . app_path('src/view/pages/auth/change_password.php'));
  exit();
}

$usuarioDAO = new UsuarioDAO();
$usuario = $usuarioDAO->getById($usuarioLogueado['id_usuario']);

if (!$usuario || $usuario->claveUsuario !== md5($passActual)) {
  setSessionError("La contraseña actual es incorrecta.");
  header("Location: " . app_path('src/view/pages/auth/change_password.php'));
  exit();
}

$query = "UPDATE usuario 
          SET clave_usuario = '" . md5($passNueva) . "'
          WHERE id_usuario = '" . $usuario->idUsuario . "';";

$result = $usuarioDAO->querySQL($query);

if (!$result) {
  setSessionError("Error al actualizar la contraseña.");
  header("Location: " . app_path('src/view/pages/auth/change_password.php'));
  exit();
}

setSessionSuccess("Contraseña actualizada correctamente.");
header("Location: " . app_path('index.php'));
exit();