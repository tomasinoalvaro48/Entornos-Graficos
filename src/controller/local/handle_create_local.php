<?php
require_once __DIR__ . "/../auth.php";
require_once __DIR__ . "/../../data/LocalDAO.php";
require_once __DIR__ . "/../../data/UsuarioDAO.php";
require_once __DIR__ . "/../../model/Local.php";
require_once __DIR__ . "/../../model/Usuario.php";

if (isset($_POST['botonCrear'])) {
  $localDAO = new LocalDAO();
  $nombreLocal = $_POST['nombre_local'];

  $duplicatedLocal = $localDAO->getByNombre($nombreLocal);

  if ($duplicatedLocal) {
    setSessionError("Ya existe un local con el nombre: {$duplicatedLocal->nombreLocal}.");
    header("Location: /src/view/pages/local/create_local.php");
  } else {
    $localDAO->create(new Local(
      null,
      $_POST['ubicacion_local'],
      $_POST['nombre_local'],
      $_POST['rubro_local'],
      $dueno = (new UsuarioDAO())->getById($_POST['dueno_local'])
    ));
    setSessionSuccess("Local creado exitosamente.");
    header("Location: /src/view/pages/local/local_list.php");
  }
}
