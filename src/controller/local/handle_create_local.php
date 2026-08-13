<?php
require_once __DIR__ . "/../auth.php";
require_once __DIR__ . "/../../data/LocalDAO.php";
require_once __DIR__ . "/../../data/UsuarioDAO.php";
require_once __DIR__ . "/../../model/Local.php";
require_once __DIR__ . "/../../model/Usuario.php";

if (isset($_POST['botonCrear'])) {
  $localDAO = new LocalDAO();
  $nombreLocal = $_POST['nombre_local'];
  $imagenLocal = 'default_local.svg';

  if (isset($_FILES['imagen_local']) && $_FILES['imagen_local']['error'] === UPLOAD_ERR_OK && is_uploaded_file($_FILES['imagen_local']['tmp_name'])) {
    $uploadDir = __DIR__ . '/../../img/locales/';
    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0777, true);
    }

    $nombreArchivo = basename($_FILES['imagen_local']['name']);
    $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));
    $permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];

    if (in_array($extension, $permitidas, true)) {
      $nombreFinal = 'local_' . time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', pathinfo($nombreArchivo, PATHINFO_FILENAME)) . '.' . $extension;
      $rutaDestino = $uploadDir . $nombreFinal;

      if (move_uploaded_file($_FILES['imagen_local']['tmp_name'], $rutaDestino)) {
        $imagenLocal = $nombreFinal;
      }
    }
  }

  $duplicatedLocal = $localDAO->getByNombre($nombreLocal);

  if ($duplicatedLocal) {
    setSessionError("Ya existe un local con el nombre: {$duplicatedLocal->nombreLocal}");
    header("Location: " . app_path('src/view/pages/local/create_local.php'));
  } else {
    $localDAO->create(new Local(
      null,
      $_POST['ubicacion_local'],
      $_POST['nombre_local'],
      $_POST['rubro_local'],
      $dueno = (new UsuarioDAO())->getById($_POST['dueno_local']),
      null,
      $imagenLocal
    ));
    setSessionSuccess("Local creado exitosamente.");
    header("Location: " . app_path('src/view/pages/local/local_list.php'));
  }
}
