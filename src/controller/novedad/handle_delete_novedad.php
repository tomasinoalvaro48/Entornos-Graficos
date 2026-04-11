<?php


require_once __DIR__ . "/../auth.php";
require_once __DIR__ . "/../../data/NovedadDAO.php";

if (isset($_GET['id'])) {
  $novedadDAO = new NovedadDAO();
  $novedadDAO->delete($_GET['id']);
  setSessionSuccess("Novedad eliminada exitosamente.");
  header("Location: /src/view/pages/novedad/novedad_list.php");
}
