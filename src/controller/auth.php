<?php
require_once __DIR__ . "/../config/env.php";
require_once __DIR__ . "/../model/Usuario.php";
// auth.php: Funciones relacionadas con la autenticación de usuarios, 
// manejo de sesiones, cookies y mensajes de error o éxito entre páginas.

function app_base_path()
{
  return rtrim($_ENV['APP_BASE_PATH'] ?? '', '/');
}

function app_path($path = '')
{
  $basePath = app_base_path();
  $normalizedPath = ltrim($path, '/');

  if ($normalizedPath === '') {
    return $basePath === '' ? '/' : $basePath . '/';
  }

  return ($basePath === '' ? '' : $basePath) . '/' . $normalizedPath;
}

function app_url($path = '')
{
  $appUrl = rtrim($_ENV['APP_URL'], '/');
  $relativePath = app_path($path);

  if ($relativePath === '/') {
    return $appUrl . '/';
  }

  return $appUrl . $relativePath;
}

function ensureSessionActive()
{
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
}

// Función para iniciar una sesión de usuario, guardando su id, tipo y categoría en la sesión.
function startSession(Usuario $usuario)
{
  ensureSessionActive();
  $_SESSION['id_usuario'] = $usuario->idUsuario;
  $_SESSION['tipo_usuario'] = $usuario->tipoUsuario;
  // En caso de ser cliente, también guardamos su categoría para mostrarle las novedades correspondientes a su categoría.
  if ($usuario->categoriaCliente) {
    $_SESSION['categoria_cliente'] = $usuario->categoriaCliente;
  }
}

// Función para obtener el tipo de usuario de la sesión actual (dueno, cliente o null si no hay sesión)
function getTipoUsuario()
{
  ensureSessionActive();
  return $_SESSION["tipo_usuario"] ?? null;
}

// Función para obtener la categoría de cliente de la sesión actual (inicial, medium, premium o null si no hay sesión o no es cliente)
function getCategoriaCliente()
{
  ensureSessionActive();
  return $_SESSION["categoria_cliente"] ?? null;
}

function getUsuarioLogueado()
{
  ensureSessionActive();

  return [
    'id_usuario' => $_SESSION['id_usuario'] ?? null,
    'tipo_usuario' => $_SESSION['tipo_usuario'] ?? null,
    'categoria_cliente' => $_SESSION['categoria_cliente'] ?? null
  ];
}

// Función para setear un mensaje de éxito en la sesión, que puede ser mostrado en la siguiente página 
// a la que se redirige.
function setSessionSuccess($message)
{
  ensureSessionActive();
  $_SESSION["success"] = $message;
}

// Función para obtener el mensaje de éxito guardado en la sesión, si existe, o null si no hay mensaje.
function getSessionSuccess()
{
  ensureSessionActive();
  return $_SESSION["success"] ?? null;
}

// Función para setear un mensaje de error en la sesión, que puede ser mostrado en la siguiente página 
// a la que se redirige.
function setSessionError($error)
{
  ensureSessionActive();
  $_SESSION["error"] = $error;
}

// Función para obtener el mensaje de error guardado en la sesión, si existe, o null si no hay mensaje.
function getSessionError()
{
  ensureSessionActive();
  return $_SESSION["error"] ?? null;
}

// Función para limpiar el mensaje de error guardado en la sesión.
function clearSessionMessages()
{
  ensureSessionActive();
  unset($_SESSION["success"]);
  unset($_SESSION["error"]);
}

// Función para eliminar datos de sesión del usuario (usado en logout).
function endSession()
{
  ensureSessionActive();
  session_unset();
  session_destroy();
}

function startCookies(Usuario $usuario)
{
  require_once __DIR__ . "/../model/Usuario.php";
  setcookie('tipo_usuario', $usuario->tipoUsuario, time() + (86400 * 30), "/"); // 30 días
  setcookie('categoria_cliente', $usuario->categoriaCliente, time() + (86400 * 30), "/"); // 30 días
}
