<?php

require_once "../env.php";

function createDataBase(){
    global $hostname, $username, $password, $dbname;
    $link = mysqli_connect($hostname, $username, $password, $dbname)
            or die ("Problemas de conexión a la base de datos");
    $sql = "CREATE DATABASE IF NOT EXISTS tp_entornos_graficos
            CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
            USE tp_entornos_graficos;
            CREATE TABLE IF NOT EXISTS ";
    $resultado = mysqli_query($link, $sql);
    if ($resultado) {
        echo "Base de datos creada exitosamente.";
    } else {
        echo "Base de datos ya existe ó error al crear la base de datos.";
    }
    mysqli_close($link);
}

function querySQL($consulta){
    global $hostname, $username, $password, $dbname;
    $link = mysqli_connect($hostname, $username, $password, $dbname) 
            or die("Problemas de conexión a la base de datos");
    $resultado = mysqli_query($link, $consulta);
    mysqli_close($link);
    return $resultado;
}

?>