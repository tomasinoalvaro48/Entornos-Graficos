<?php
//isset($var): Determina si una variable está definida y no es NULL. False: null, True: otro.
//gettype($mivar): Devuelve el tipo de la variable.

//$_GET[]: Array asociativo de variables pasadas al script actual a través de la URL. 
//$_POST[]: Array asociativo de variables pasadas al script actual a través del método HTTP POST.

require_once("db_functions.php");

if(isset($_POST['botonIniciar'])){

        $arreglo = $_POST;

        $query = "SELECT * FROM usuario WHERE nombreUsr = '".$arreglo['mail']."' AND claveUsr = '".md5($arreglo['pass'])."';";
        $usuarioValido = querySQL($query);

        if($usuarioValido){
            echo "<br>¡Bienvenido!</br>";

        } else{
            header('Location: ../LoginForm.html');
            echo '
            <br>
            <div style="color: red;"> Usuario o contraseña incorrectos </div>';
    }
}

?>