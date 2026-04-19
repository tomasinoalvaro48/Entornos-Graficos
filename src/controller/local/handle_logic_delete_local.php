<?php
require_once __DIR__ . "/../../data/LocalDAO.php";
require_once __DIR__ . "/../auth.php";

if (isset($_GET['id'])) {
  $localDAO = new LocalDAO();
  $localDAO->logicDelete($_GET['id']);
  setSessionSuccess("Local eliminado exitosamente.");
  header("Location: " . app_path('src/view/pages/local/local_list.php'));
  exit();
}
