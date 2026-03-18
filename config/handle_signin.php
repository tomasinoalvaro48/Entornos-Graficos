<?php
require_once "db_functions.php";

if (isset($_POST['botonCrear'])) {
    $arreglo = $_POST;
    $rol = "cliente";
    $catCliente = "inicial";

    $query = "SELECT * FROM usuario WHERE email_usuario = '" . $arreglo['email_usuario'] . "';";
    if (querySQL($query) && querySQL($query)->num_rows > 0) {
        echo "
        <br>
        Email de usuario ya existente";
    } else {
        $query = "INSERT INTO usuario (nombre_usuario, email_usuario, clave_usuario, tipo_usuario, categoria_cliente) 
                VALUES ('" . $arreglo['nombre_usuario'] . "', '" . $arreglo['email_usuario'] . "', '" . md5($arreglo['clave_usuario']) . "', '" . $rol . "', '" . $catCliente . "');";
        querySQL($query);
        header("Location: /login");
    }
}
