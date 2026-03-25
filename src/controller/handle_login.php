<?php

//$_GET[]: Array asociativo de variables pasadas al script actual a través de la URL. 
//$_POST[]: Array asociativo de variables pasadas al script actual a través del método HTTP POST.
require_once "../data/UsuarioDAO.php";
require_once "../model/Auth.php";
session_start();

if (isset($_POST['botonIniciar'])) {
    $usuario = (new UsuarioDAO())->getByEmailAndClave($_POST['mail'], $_POST['pass']);

    if ($usuario) {
        $auth = new Auth();
        $auth->startSession($usuario);
        return true;
    } else {
        $_SESSION['error'] = "Usuario o contraseña incorrectos";
        return false;
    }
}
