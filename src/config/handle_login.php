<?php
//$_GET[]: Array asociativo de variables pasadas al script actual a través de la URL. 
//$_POST[]: Array asociativo de variables pasadas al script actual a través del método HTTP POST.

require_once("db_functions.php");
require_once("auth.php");

if (isset($_POST['botonIniciar'])) {

    $arreglo = $_POST;

    $query = "SELECT * FROM usuario WHERE email_usuario = '" . $arreglo['mail'] . "' AND clave_usuario = '" . md5($arreglo['pass']) . "';";
    $usuarioValido = querySQL($query);

    if ($usuarioValido) {
        $usuario = mysqli_fetch_array($usuarioValido);
        startSession($usuario);
        echo '<script>window.location.href = "/";</script>';
    } else {
        echo '<script>window.location.href = "/login";</script>';
    }
}
