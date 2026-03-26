<?php

class Auth
{
  public function startSession(Usuario $usuario)
  {
    $_SESSION['id_usuario'] = $usuario->idUsuario;
    $_SESSION['tipo_usuario'] = $usuario->tipoUsuario;
    $_SESSION['categoria_cliente'] = $usuario->categoriaCliente;
  }

  public function endSession()
  {
    session_start();
    session_unset();
    session_destroy();
  }

  public function startCookies(Usuario $usuario)
  {
    setcookie('tipo_usuario', $usuario->tipoUsuario, time() + (86400 * 30), "/"); // 30 días
    setcookie('categoria_cliente', $usuario->categoriaCliente, time() + (86400 * 30), "/");
  }
}
