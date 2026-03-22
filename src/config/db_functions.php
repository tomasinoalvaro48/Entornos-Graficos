<?php

require_once "../../env.php";

function querySQL($consulta)
{
    global $hostname, $username, $password, $dbname;
    $link = mysqli_connect($hostname, $username, $password, $dbname);
    
    if (!$link) {
        die("Error de conexión: " . mysqli_connect_error());
    }
    
    $resultado = mysqli_query($link, $consulta);
    mysqli_close($link);
    return $resultado;
}
