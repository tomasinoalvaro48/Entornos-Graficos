<?php
require_once __DIR__ . "/../../data/UsuarioDAO.php";
require_once __DIR__ . "/../auth.php";

if (isset($_GET['id']) && isset($_GET['estado'])) {
  $idDueno = $_GET['id'];
  $estado = $_GET['estado'];

  $usuarioDAO = new UsuarioDAO();
  $dueno = $usuarioDAO->getById($_GET['id']);

  // Verificar que el dueño exista antes de intentar actualizar su estado
  if ($dueno) {
    $dueno->estadoDueno = $estado; // Asignar el nuevo estado al objeto Dueño
    $updateResult = $usuarioDAO->updateEstadoDueno((int)$idDueno, $estado); // Actualizar el estado en la base de datos
  } else {
    // Si el dueño no existe
    setSessionError("El dueño con ID $idDueno no existe.");
  }

  // Si se actualizó correctamente
  if ($updateResult) {
    setSessionSuccess("El estado del dueño con ID $idDueno ha sido actualizado a '$estado' exitosamente.");
  } else {
    setSessionError("Hubo un error al actualizar el estado del dueño con ID $idDueno. Por favor, intente nuevamente.");
  }
  header("Location: /src/view/pages/usuario/validar_cuentas_dueno.php");
  exit();
}
