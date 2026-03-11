<?php
require_once("funciones.php");

if(isset($_POST['botonCrear'])){
    $arreglo = $_POST;

    $query = "SELECT * FROM usuario WHERE nombreUsr = '" .$arreglo['usuario'] . "';";
    if(consultaSQL($query)){
        echo "
        <br>
        Nombre de usuario ya existente";
    }
}

?>