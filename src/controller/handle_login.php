<?php

//$_GET[]: Array asociativo de variables pasadas al script actual a través de la URL. 
//$_POST[]: Array asociativo de variables pasadas al script actual a través del método HTTP POST.
require_once __DIR__ . "/../data/UsuarioDAO.php";
require_once __DIR__ . "/../controller/auth.php";

if (isset($_POST['botonIniciar'])) {
    $usuario = (new UsuarioDAO())->getByEmailAndClave($_POST['mail'], $_POST['pass']);

    if ($usuario) {
        startSession($usuario);
        header("Location: /index.php");
    } else {
        setSessionError("Usuario o contraseña incorrectos");
        header("Location: /src/view/pages/login.php");
    }
}
