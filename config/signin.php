<?php
require_once "db_functions.php";

if (isset($_POST['botonCrear'])) {
    $arreglo = $_POST;
    $rol = "cliente";

    $query = "SELECT * FROM usuario WHERE nombre_usuario = '" . $arreglo['nombre_usuario'] . "';";
    if (querySQL($query)) {
        echo "
        <br>
        Nombre de usuario ya existente";
    } else {
        $query = "INSERT INTO usuario (nombre_usuario, email_usuario, clave_usuario, tipo_usuario) 
                VALUES ('" . $arreglo['nombre_usuario'] . "', '" . $arreglo['email_usuario'] . "', '" . md5($arreglo['clave_usuario']) . "', '" . $rol . "');";
        querySQL($query);
        header("Location: /login");
    }
}
