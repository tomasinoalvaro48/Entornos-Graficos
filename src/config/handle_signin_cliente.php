<?php
session_start();
require_once "db_functions.php";

if (isset($_POST['botonCrear'])) {
    $arreglo = $_POST;
    $rol = "cliente";
    $catCliente = "inicial";

    $query = "SELECT * FROM usuario WHERE email_usuario = '" . $arreglo['email_usuario'] . "';";
    $usuario = querySQL($query);
    if ($usuario && $usuario->num_rows > 0) {
        $_SESSION['error'] = "Este usuario ya existe. Por favor, intente con otro correo electrónico o inicie sesión.";
        header("Location: /src/public/pages/signin.php");
        exit();
    } else {
        $query = "INSERT INTO usuario (nombre_usuario, email_usuario, clave_usuario, tipo_usuario, categoria_cliente) 
                VALUES ('" . $arreglo['nombre_usuario'] . "', '" . $arreglo['email_usuario'] . "', '" . md5($arreglo['clave_usuario']) . "', '" . $rol . "', '" . $catCliente . "');";
        querySQL($query);
        $_SESSION['success'] = "Usuario creado exitosamente. Por favor, inicie sesión.";
        header("Location: /src/public/pages/login.php");
        exit();
    }
}
