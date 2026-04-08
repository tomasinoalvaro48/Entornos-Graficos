<?php

require_once __DIR__ . "/../model/Usuario.php";
require_once __DIR__ . "/DBFunctions.php";

class UsuarioDAO extends DBFunctions
{
  // Función para convertir un array de resultado de la base de datos en un objeto Usuario
  protected function sanitizeUser($usuarioFecthArray)
  {
    $u = null;
    if ($usuarioFecthArray) {
      $u = new Usuario(
        $usuarioFecthArray['id_usuario'],
        $usuarioFecthArray['nombre_usuario'],
        $usuarioFecthArray['email_usuario'],
        $usuarioFecthArray['clave_usuario'],
        $usuarioFecthArray['tipo_usuario'],
        $usuarioFecthArray['categoria_cliente'],
        $usuarioFecthArray['estado_dueno']
      );
    }
    return $u;
  }

  public function getAll()
  {
    $usuariosArray = [];
    $query = "SELECT * FROM usuario;";
    $usuarios = $this->querySQL($query);
    if ($usuarios && $usuarios->num_rows > 0) {
      while ($usuario = mysqli_fetch_array($usuarios)) {
        array_push($usuariosArray, $this->sanitizeUser($usuario));
      }
    }
    return $usuariosArray;
  }

  public function getAllDuenos()
  {
    $duenosArray = [];
    $query = "SELECT * FROM usuario WHERE tipo_usuario = 'dueno' ORDER BY estado_dueno DESC;";
    $duenos = $this->querySQL($query);
    if ($duenos && $duenos->num_rows > 0) {
      while ($dueno = mysqli_fetch_array($duenos)) {
        array_push($duenosArray, $this->sanitizeUser($dueno));
      }
    }
    return $duenosArray;
  }

  public function getByEmail($email)
  {
    $u = null;
    $query = "SELECT * FROM usuario WHERE email_usuario = '" . $email . "';";
    $usuario = $this->querySQL($query);
    if ($usuario && $usuario->num_rows > 0) {
      $u = $this->sanitizeUser(mysqli_fetch_array($usuario));
    }
    return $u;
  }

  public function getByEmailAndClave($email, $clave)
  {
    $u = null;
    $query = "SELECT * FROM usuario WHERE email_usuario = '" . $email . "' AND clave_usuario = '" . md5($clave) . "';";
    $usuarioValido = $this->querySQL($query);
    if ($usuarioValido && $usuarioValido->num_rows > 0) {
      $u = $this->sanitizeUser(mysqli_fetch_array($usuarioValido));
    }
    return $u;
  }

  public function getById($id)
  {
    $u = null;
    $query = "SELECT * FROM usuario WHERE id_usuario = '" . $id . "';";
    $usuario = $this->querySQL($query);
    if ($usuario && $usuario->num_rows > 0) {
      $u = $this->sanitizeUser(mysqli_fetch_array($usuario));
    }
    return $u;
  }

  public function create(Usuario $usuario)
  {
    $query = "INSERT INTO usuario (nombre_usuario, email_usuario, clave_usuario, tipo_usuario, categoria_cliente, estado_dueno) 
                VALUES ('" . $usuario->nombreUsuario . "', '" . $usuario->emailUsuario . "', 
                '" . md5($usuario->claveUsuario) . "', '" . $usuario->tipoUsuario . "', '" . $usuario->categoriaCliente . "',
                '" . $usuario->estadoDueno . "');";
    return $this->querySQL($query);
  }
}
