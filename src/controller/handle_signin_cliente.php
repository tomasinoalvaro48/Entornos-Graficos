<?php
require "../data/UsuarioDAO.php";

if (isset($_POST['botonCrear'])) {
    $udao = new UsuarioDAO();
    $usuario = $udao->getByEmail($_POST['email_usuario']);
    if ($usuario) {
        $_SESSION['error'] = "Este usuario ya existe. Por favor, intente con otro correo electrónico o inicie sesión.";
        header("Location: /src/public/pages/signin.php");
    } else {
        $udao->create(new Usuario(
            null,
            $_POST['nombre_usuario'],
            $_POST['email_usuario'],
            $_POST['clave_usuario'],
            'cliente',
            'inicial'
        ));
        $_SESSION['success'] = "Usuario creado exitosamente. Por favor, inicie sesión.";
        header("Location: /src/public/pages/login.php");
    }
}
