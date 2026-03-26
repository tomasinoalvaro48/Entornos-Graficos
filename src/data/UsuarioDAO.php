<?php

require "../model/Usuario.php";
require "DBFunctions.php";

class UsuarioDAO extends DBFunctions
{

  function sanitizeUser($usuarioMySQLiResult)
  {
    $u = null;
    if ($usuarioMySQLiResult && $usuarioMySQLiResult->num_rows > 0) {
      $usuario = mysqli_fetch_array($usuarioMySQLiResult);
      $u = new Usuario(
        $usuario['id_usuario'],
        $usuario['nombre_usuario'],
        $usuario['email_usuario'],
        $usuario['clave_usuario'],
        $usuario['tipo_usuario'],
        $usuario['categoria_cliente']
      );
    }
    return $u;
  }

  function getByEmail($email)
  {
    $query = "SELECT * FROM usuario WHERE email_usuario = '" . $email . "';";
    $usuario = $this->querySQL($query);
    return $this->sanitizeUser($usuario);
  }

  public function getByEmailAndClave($email, $clave)
  {
    $query = "SELECT * FROM usuario WHERE email_usuario = '" . $email . "' AND clave_usuario = '" . md5($clave) . "';";
    $usuarioValido = $this->querySQL($query);
    return $this->sanitizeUser($usuarioValido);
  }

  public function create(Usuario $usuario)
  {
    $query = "INSERT INTO usuario (nombre_usuario, email_usuario, clave_usuario, tipo_usuario, categoria_cliente) 
                VALUES ('" . $usuario->nombreUsuario . "', '" . $usuario->emailUsuario . "', 
                '" . md5($usuario->claveUsuario) . "', '" . $usuario->tipoUsuario . "', '" . $usuario->categoriaCliente . "');";
    $newUsuario = $this->querySQL($query);
    return $this->sanitizeUser($newUsuario);
  }
}
