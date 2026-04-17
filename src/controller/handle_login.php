<?php

//$_GET[]: Array asociativo de variables pasadas al script actual a través de la URL. 
//$_POST[]: Array asociativo de variables pasadas al script actual a través del método HTTP POST.
require_once __DIR__ . "/../data/UsuarioDAO.php";
require_once __DIR__ . "/../controller/auth.php";

if (isset($_POST['botonIniciar'])) {
    $usuario = (new UsuarioDAO())->getByEmailAndClave($_POST['mail'], $_POST['pass']);

    // Verificar si el usuario existe
    if (!$usuario) {
        setSessionError("Usuario o contraseña incorrectos");
        header("Location: " . app_path('src/view/pages/auth/login.php'));
        exit();
    }

    // Verificar si el usuario es un cliente sin confirmar
    if ($usuario->estadoMail === 'no_confirmado') {
        setSessionError("Su cuenta no ha sido confirmada. Por favor, revise su correo electrónico para confirmar su cuenta.");
        header("Location: " . app_path('src/view/pages/auth/login.php'));
        exit();
    }

    // Verificar si el usuario es un dueño pendiente de aprobación
    if ($usuario->estadoDueno && $usuario->estadoDueno === 'pendiente') {
        setSessionError("Su cuenta de dueño está pendiente de aprobación. Le avisaremos a su mail cuando su cuenta sea aprobada por un administrador.");
        header("Location: " . app_path('src/view/pages/auth/login.php'));
        exit();
    }

    if ($usuario->estadoDueno === 'rechazado') {
        setSessionError("Su cuenta de dueño fue rechazada por un administrador.");
        header("Location: " . app_path('src/view/pages/auth/login.php'));
        exit();
    }

    // Iniciar sesión y redirigir al usuario a la página principal
    startSession($usuario);
    header("Location: " . app_path('index.php'));
    exit();
}
