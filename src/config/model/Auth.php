<?php

class Auth
{
  function startSession($usuario)
  {
    $_SESSION['id_usuario'] = $usuario['id_usuario'];
    $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];
    $_SESSION['categoria_cliente'] = $usuario['categoria_cliente'];
  }

  function endSession()
  {
    session_unset();
    session_destroy();
  }
}
