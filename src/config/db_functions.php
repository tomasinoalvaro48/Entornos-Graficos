<?php

require_once "../../env.php";

function querySQL($consulta)
{
    global $hostname, $username, $password, $dbname;
    $link = mysqli_connect($hostname, $username, $password, $dbname)
        or die("Problemas de conexión a la base de datos");
    $resultado = mysqli_query($link, $consulta);
    mysqli_close($link);
    return $resultado;
}
