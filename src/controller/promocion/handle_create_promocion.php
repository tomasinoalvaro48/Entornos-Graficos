<?php
require_once __DIR__ . "/../auth.php";
require_once __DIR__ . "/../../data/PromocionDAO.php";
require_once __DIR__ . "/../../data/LocalDAO.php";
require_once __DIR__ . "/../../model/Promocion.php";
require_once __DIR__ . "/../../model/Local.php";

if (isset($_POST['botonCrear'])) {
  $promocionDAO = new PromocionDAO();
  $localDAO = new LocalDAO();

  if (empty($_POST['dias_semana'])) {
    setSessionError("Debe seleccionar al menos un día.");
    header("Location: " . app_path('src/view/pages/promocion/create_promocion.php'));
  } else if ($_POST['fecha_desde'] > $_POST['fecha_hasta']) {
    setSessionError("La fecha desde no puede ser mayor a la fecha hasta.");
    header("Location: " . app_path('src/view/pages/promocion/create_promocion.php'));
  } else {
    $diasSemana = new ArrayObject($_POST['dias_semana']);

    $promocionDAO->create(new Promocion(
      null,
      $_POST['texto_promo'],
      new DateTime($_POST['fecha_desde']),
      new DateTime($_POST['fecha_hasta']),
      $_POST['categoria_cliente'],
      $diasSemana,
      "pendiente",
      $localDAO->getById($_POST['id_local'])
    ));

    setSessionSuccess("Promoción creada exitosamente. Queda pendiente de aprobación.");
    header("Location: " . app_path('src/view/pages/promocion/promocion_list.php'));
  }
}
