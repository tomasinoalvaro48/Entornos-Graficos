<?php
require_once __DIR__ . "/../data/UsuarioDAO.php";
require_once __DIR__ . "/auth.php";
require_once __DIR__ . "/send_verification_mail.php";

function isValidEmailAddress($email)
{
  return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// Este controlador maneja el proceso de registro tanto para clientes como para dueños, 
// incluyendo la validación de datos, generación de tokens de verificación y envío de 
// correos electrónicos de confirmación.
$udao = new UsuarioDAO();

// --------------------- Manejo de registro de CLIENTE ---------------------
if (isset($_POST['botonCrearCliente'])) {
  $emailUsuario = $_POST['email_usuario'];
  $claveUsuario = $_POST['clave_usuario'];
  $claveUsuarioConf = $_POST['clave_usuario_conf'];
  $nombreUsuario = $_POST['nombre_usuario'];

  if (!isValidEmailAddress($emailUsuario)) {
    setSessionError("Ingrese un correo electrónico válido.");
    header("Location: " . app_path('src/view/pages/auth/signin.php'));
    exit();
  }

  $usuario = $udao->getByEmail($emailUsuario);

  // Verificar si el correo electrónico ya está registrado
  if ($usuario) {
    setSessionError("Este usuario ya existe. Por favor, intente con otro correo electrónico o inicie sesión.");
    header("Location: " . app_path('src/view/pages/auth/signin.php'));
    exit();
  }

  // Verificar que las contraseñas coincidan
  if ($claveUsuario !== $claveUsuarioConf) {
    setSessionError("Las contraseñas no coinciden. Por favor, intente nuevamente.");
    header("Location: " . app_path('src/view/pages/auth/signin.php'));
    exit();
  }

  // Generar un token de verificación único
  $token = bin2hex(random_bytes(16));
  // Enviar el correo de verificación
  $mailSent = sendVerificationEmail($emailUsuario, $token, $nombreUsuario);
  if (!$mailSent) {
    setSessionError("No se pudo enviar el correo de verificación. Por favor, intente nuevamente.");
    header("Location: " . app_path('src/view/pages/auth/signin.php'));
    exit();
  }

  // Crear el nuevo CLIENTE con estado_cliente 'inicial' y estado 'sinconfirmar' 
  $udao->create(new Usuario(
    null,
    $nombreUsuario,
    $emailUsuario,
    $claveUsuario,
    'cliente',
    'inicial',
    null,
    'no_confirmado',
    $token
  ));
  setSessionSuccess("Por favor, verifique su mail antes de acceder.");
}

// --------------------- Manejo de registro de DUEÑO ---------------------
if (isset($_POST['botonSolicitarDueno'])) {
  $emailUsuario = $_POST['email_dueno'];
  $claveUsuario = $_POST['clave_dueno'];
  $claveUsuarioConf = $_POST['clave_dueno_conf'];
  $nombreUsuario = $_POST['nombre_dueno'];

  if (!isValidEmailAddress($emailUsuario)) {
    setSessionError("Ingrese un correo electrónico válido.");
    header("Location: " . app_path('src/view/pages/auth/signin_dueno.php'));
    exit();
  }

  // Verificar si el correo electrónico ya está registrado
  $usuario = $udao->getByEmail($emailUsuario);
  if ($usuario) {
    setSessionError("Este usuario ya existe. Por favor, intente con otro correo electrónico o inicie sesión.");
    header("Location: " . app_path('src/view/pages/auth/signin_dueno.php'));
    exit();
  }

  // Verificar que las contraseñas coincidan
  if ($claveUsuario !== $claveUsuarioConf) {
    setSessionError("Las contraseñas no coinciden. Por favor, intente nuevamente.");
    header("Location: " . app_path('src/view/pages/auth/signin_dueno.php'));
    exit();
  }

  // Generar un token de verificación único
  $token = bin2hex(random_bytes(16));
  // Enviar el correo de verificación
  $emailSent = sendVerificationEmail($emailUsuario, $token, $nombreUsuario);
  if (!$emailSent) {
    setSessionError("No se pudo enviar el correo de verificación. Por favor, intente nuevamente.");
    header("Location: " . app_path('src/view/pages/auth/signin_dueno.php'));
    exit();
  }

  // Crear el nuevo DUEÑO con estado 'pendiente'
  $udao->create(new Usuario(
    null,
    $nombreUsuario,
    $emailUsuario,
    $claveUsuario,
    'dueno',
    null,
    'pendiente',
    'no_confirmado',
    $token
  ));

  setSessionSuccess("Por favor, verifique su mail antes de continuar.");
}

header("Location: " . app_path('src/view/pages/auth/login.php'));
exit();
