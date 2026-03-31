<?php

require_once __DIR__ . "/../auth.php";
require_once __DIR__ . "/../../data/LocalDAO.php";
require_once __DIR__ . "/../../data/PromocionDAO.php";

if (isset($_GET['id'])) {
  if ((new PromocionDAO)->getByLocalId($_GET['id'])) {
    setSessionError("No se puede eliminar el local porque tiene promociones asociadas.");
    header("Location: /src/view/pages/local/local_list.php");
  }
  $localDAO = new LocalDAO();
  $localDAO->delete($_GET['id']);
  setSessionSuccess("Local eliminado exitosamente.");
  header("Location: /src/view/pages/local/local_list.php");
}
