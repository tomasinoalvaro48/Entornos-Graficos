<?php

function consultaSQL($consulta){
    $link = mysqli_connect("localhost","root","","tp_desarrollo_web") or die ("Problemas de conexión a la base de
    datos");
    $resultado = mysqli_query($link, $consulta);
    mysqli_close($link);
    return $resultado;
}


?>