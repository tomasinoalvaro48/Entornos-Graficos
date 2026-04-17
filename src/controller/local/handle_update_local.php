<?php
require_once __DIR__ . "/../auth.php";
require_once __DIR__ . "/../../data/LocalDAO.php";
require_once __DIR__ . "/../../data/UsuarioDAO.php";
require_once __DIR__ . "/../../model/Local.php";
require_once __DIR__ . "/../../model/Usuario.php";

if (isset($_POST['botonActualizar'])) {
  $localDAO = new LocalDAO();
  $nombreLocal = $_POST['nombre_local'];

  // Verificar si el nuevo nombre del local ya existe en otro registro que no sea el actual
  $duplicatedLocal = $localDAO->getByNombre($nombreLocal);

  if ($duplicatedLocal && $duplicatedLocal->idLocal != $_GET['id']) {
    setSessionError("Ya existe un local con el nombre: {$duplicatedLocal->nombreLocal}");
    header("Location: " . app_path('src/view/pages/local/local_list.php'));
  } else {
    // Si no hay duplicados, proceder a actualizar el local
    $localDAO->update(new Local(
      $_GET['id'],
      $_POST['ubicacion_local'],
      $_POST['nombre_local'],
      $_POST['rubro_local'],
      $dueno = (new UsuarioDAO())->getById($_POST['dueno_local'])
    ));
    setSessionSuccess("Local actualizado exitosamente.");
    header("Location: " . app_path('src/view/pages/local/local_list.php'));
  }
}
