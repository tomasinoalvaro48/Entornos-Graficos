<?php
require_once __DIR__ . "/../auth.php";
require_once __DIR__ . "/../../data/UsoPromocionDAO.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
  $usuario = getUsuarioLogueado();
  $idCli = $usuario['id_usuario'];
  $idPromo = $_POST['id_promo'];

  $usoPromocionDAO = new UsoPromocionDAO();
  $resultado = $usoPromocionDAO->create($idCli, $idPromo);

  if ($resultado) {
    setSessionSuccess("Promoción solicitada correctamente.");
  } else {
    setSessionError("Ya solicitaste esta promoción.");
  }

  header("Location: " . app_path('src/view/pages/promocion/promos_cliente.php'));
  exit();
}