<?php

// auth.php: Funciones relacionadas con la autenticación de usuarios, 
// manejo de sesiones, cookies y mensajes de error o éxito entre páginas.

function ensureSessionActive()
{
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
}

// Función para iniciar una sesión de usuario, guardando su id, tipo y categoría en la sesión.
function startSession(Usuario $usuario)
{
  require_once __DIR__ . "/../model/Usuario.php";
  ensureSessionActive();
  $_SESSION['id_usuario'] = $usuario->idUsuario;
  $_SESSION['tipo_usuario'] = $usuario->tipoUsuario;
}

// Función para obtener el tipo de usuario de la sesión actual (dueno, cliente o null si no hay sesión)
function getTipoUsuario()
{
  ensureSessionActive();
  return $_SESSION["tipo_usuario"] ?? null;
}

// Función para setear un mensaje de éxito en la sesión, que puede ser mostrado en la siguiente página 
// a la que se redirige.
function setSessionSuccess($message)
{
  ensureSessionActive();
  $_SESSION["success"] = $message;
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
function clearSessionError()
{
  ensureSessionActive();
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
  setcookie('categoria_cliente', $usuario->categoriaCliente, time() + (86400 * 30), "/");
}
