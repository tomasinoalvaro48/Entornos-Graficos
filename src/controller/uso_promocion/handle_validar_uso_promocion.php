<?php

require_once __DIR__ . "/../../data/UsoPromocionDAO.php";
require_once __DIR__ . "/../auth.php";

if (isset($_GET['id_cli']) && isset($_GET['id_promo']) && isset($_GET['estado'])) {
  $idCli = $_GET['id_cli'];
  $idPromo = $_GET['id_promo'];
  $estado = $_GET['estado'];

  $usoDAO = new UsoPromocionDAO();
  $updateResult = $usoDAO->updateEstado($idCli, $idPromo, $estado);

  if ($updateResult) {
    setSessionSuccess("Solicitud actualizada a '$estado'.");
  } else {
    setSessionError("Error al actualizar la solicitud.");
  }

  header("Location: " . app_path('src/view/pages/uso_promocion/validar_uso_promocion.php'));
  exit();
}