<?php

require_once __DIR__ . "/../auth.php";
require_once __DIR__ . "/../../data/PromocionDAO.php";

if (isset($_GET['id'])) {
  $promocionDAO = new PromocionDAO();
  $promocionDAO->delete($_GET['id']);

  setSessionSuccess("Promoción eliminada exitosamente.");
  header("Location: " . app_path('src/view/pages/promocion/promocion_list.php'));
}
