<?php

class Auth
{
  public function startSession($usuario)
  {
    session_start();
    $_SESSION['id_usuario'] = $usuario->id_usuario;
    $_SESSION['tipo_usuario'] = $usuario->tipo_usuario;
    $_SESSION['categoria_cliente'] = $usuario->categoria_cliente;
  }

  public function endSession()
  {
    session_start();
    session_unset();
    session_destroy();
  }

  public function startCookies($usuario)
  {
    setcookie('tipo_usuario', $usuario->tipo_usuario, time() + (86400 * 30), "/"); // 30 días
    setcookie('categoria_cliente', $usuario->categoria_cliente, time() + (86400 * 30), "/");
  }
}
