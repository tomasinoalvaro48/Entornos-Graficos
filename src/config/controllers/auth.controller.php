<?php

function login()
{
  //$_GET[]: Array asociativo de variables pasadas al script actual a través de la URL. 
  //$_POST[]: Array asociativo de variables pasadas al script actual a través del método HTTP POST.
  require_once "../data/UsuarioDAO.php";
  require_once "Auth.php";
  session_start();

  if (isset($_POST['botonIniciar'])) {

    $arreglo = $_POST;
    $usuarioValido = (new UsuarioDAO())->getByEmailAndClave($arreglo['mail'], $arreglo['pass']);

    if ($usuarioValido && $usuarioValido->num_rows > 0) {
      $usuario = mysqli_fetch_array($usuarioValido);
      (new Auth())->startSession($usuario);
      return true;
    } else {
      $_SESSION['error'] = "Usuario o contraseña incorrectos";
      return false;
    }
  }
};
