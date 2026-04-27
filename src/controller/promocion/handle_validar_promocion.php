<?php
require_once __DIR__ . "/../../data/PromocionDAO.php";
require_once __DIR__ . "/../auth.php";
require_once __DIR__ . "/send_noti_promocion_email.php";

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
    $dueno = $promo->local->usuario;

    // Validar que el email sea válido antes de enviar (según norma rfc822: https://datatracker.ietf.org/doc/html/rfc822)
    if ($dueno && $dueno->emailUsuario && filter_var($dueno->emailUsuario, FILTER_VALIDATE_EMAIL)) {
      $mailSent = sendNotiPromocionEmail(
        $dueno->emailUsuario,
        $dueno->nombreUsuario,
        $promo->textoPromo,
        $estado
      );

      setSessionSuccess("El estado de la promoción con ID $idPromo se actualizó a '$estado'.");
    } else {
      setSessionError("Error: El email del dueño es inválido. No se pudo enviar la notificación.");
    }
  } else {
    setSessionError("Error al actualizar la promoción con ID $idPromo. Vuelva a intentarlo.");
  }

  header("Location: " . app_path('src/view/pages/promocion/validar_promociones.php'));
  exit();
}
