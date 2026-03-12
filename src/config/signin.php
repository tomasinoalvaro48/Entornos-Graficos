<?php
require_once("db_functions.php");

if(isset($_POST['botonCrear'])){
    $arreglo = $_POST;

    $query = "SELECT * FROM usuario WHERE nombreUsr = '" .$arreglo['usuario'] . "';";
    if(querySQL($query)){
        echo "
        <br>
        Nombre de usuario ya existente";
    }
}

?>