<?php
include_once __DIR__ . "/auth.php";
include_once __DIR__ . "/../data/UsuarioDAO.php";
include_once __DIR__ . "/send_contacto_email.php";
include __DIR__ . "/../enums.php";

if (isset($_POST['botonContacto'])) {
  $nombre = $_POST['contacto_nombre'] ?? null;
  $email = $_POST['contacto_email'] ?? null;
  $mensaje = $_POST['contacto_mensaje'];
  $dao = new UsuarioDAO();
  $usuario = null;

  // Obtener datos del usuario: logueado o por email proporcionado
  if (!$nombre && !$email) {
    // Usuario logueado
    $u = getUsuarioLogueado();
    if ($u) {
      $usuario = $dao->getById($u['id_usuario']);
      $nombre = $usuario->nombreUsuario;
      $email = $usuario->emailUsuario;
    }
  } else {
    // Usuario NO logueado, buscar por email
    $usuario = $dao->getByEmail($email);
  }

  // Validar que el usuario existe y tenga email confirmado
  if (!$usuario) {
    setSessionError("Por favor, ingresa un email válido o inicia sesión para contactarnos.");
    header("Location: " . app_path());
    exit();
  }

  if ($usuario->estadoMail !== EstadoMail::CONFIRMADO->value) {
    setSessionError("Tu email aún no ha sido confirmado. Por favor, verifica tu correo.");
    header("Location: " . app_path());
    exit();
  }

  // Validar que si es dueño, su cuenta esté aceptada
  if ($usuario->tipoUsuario === TipoUsuario::DUENO->value && $usuario->estadoDueno !== EstadoDueno::ACEPTADO->value) {
    setSessionError("Tu cuenta de dueño aún no ha sido aceptada. Por favor, intenta más tarde.");
    header("Location: " . app_path());
    exit();
  }

  // Validar que el email sea válido antes de enviar (según norma rfc822: https://datatracker.ietf.org/doc/html/rfc822)
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    setSessionError("El email proporcionado no es válido. No se pudo enviar email.");
    header("Location: " . app_path());
    exit();
  }

  if (sendContactEmail($nombre, $email, $mensaje)) {
    setSessionSuccess("Gracias por contactarnos, $nombre. Hemos recibido tu mensaje y nos pondremos en contacto contigo a la brevedad.");
    header("Location: " . app_path());
    exit();
  }

  setSessionError("En este momento no podemos procesar tu solicitud. Por favor, intenta nuevamente más tarde.");
  header("Location: " . app_path());
  exit();
}
