<?php

class UsuarioDAO extends DBFunctions
{

  public function getByEmailAndClave($email, $clave)
  {

    $query = "SELECT * FROM usuario WHERE email_usuario = '" . $email . "' AND clave_usuario = '" . md5($clave) . "';";
    $usuarioValido = querySQL($query);
    return $usuarioValido;
  }

  public function create($usuario)
  {
    $rol = 'cliente';
    $catCliente = 'inicial';
    $query = "INSERT INTO usuario (nombre_usuario, email_usuario, clave_usuario, tipo_usuario, categoria_cliente) 
                VALUES ('" . $usuario['nombre_usuario'] . "', '" . $usuario['email_usuario'] . "', '" . md5($usuario['clave_usuario']) . "', '" . $rol . "', '" . $catCliente . "');";
    querySQL($query);
    $_SESSION['success'] = "Usuario creado exitosamente. Por favor, inicie sesión.";
    header("Location: /src/public/pages/login.php");
    exit();
  }
}
