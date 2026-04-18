<?php
require_once __DIR__ . "/../../data/PromocionDAO.php";
require_once __DIR__ . "/../auth.php";

if (isset($_GET['id']) && isset($_GET['estado'])) {
  $idPromo = $_GET['id'];
  $estado = $_GET['estado'];

  $promocionDAO = new PromocionDAO();
  $promo = $promocionDAO->getById($_GET['id']);

  if ($promo) {
    $promo->estadoPromo = $estado;
    $updateResult = $promocionDAO->updateEstadoPromo((int)$idPromo, $estado);
  } else {
    setSessionError("La promoción con ID $idPromo no existe.");
  }

  if ($updateResult) {
    setSessionSuccess("El estado de la promoción con ID $idPromo se actualizó a '$estado'.");
  } else {
    setSessionError("Error al actualizar la promoción con ID $idPromo. Vuelva a intentarlo.");
  }

  header("Location: " . app_path('src/view/pages/promocion/validar_promociones.php'));
  exit();
}
