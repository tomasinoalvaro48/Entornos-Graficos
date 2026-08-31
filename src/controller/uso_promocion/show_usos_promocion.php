<?php

require_once __DIR__ . "/../../data/UsoPromocionDAO.php";

function showUsosPromocion()
{
  $usoDAO = new UsoPromocionDAO();
  return $usoDAO->getAllWithPromoAndLocal();
}

function showUsosPromocionAgrupados()
{
  $usos = showUsosPromocion();
  $agrupados = [];

  foreach ($usos as $uso) {
    $idPromo = $uso->idPromo;

    if (!isset($agrupados[$idPromo])) {
      $agrupados[$idPromo] = [
        'promo' => $uso->promo,
        'usos'  => []
      ];
    }

    $agrupados[$idPromo]['usos'][] = $uso;
  }

  return $agrupados;
}