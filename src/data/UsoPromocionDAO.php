<?php

require_once __DIR__ . "/DBFunctions.php";

class UsoPromocionDAO extends DBFunctions
{
  public function create($idCli, $idPromo)
  {
    if ($this->exists($idCli, $idPromo)) {
      return false;
    }

    $fecha = date('Y-m-d');

    $query = "INSERT INTO uso_promocion
              (id_cli, id_promo, fecha_uso_promo, estado_uso_promo)
              VALUES ($idCli, $idPromo, '$fecha', 'enviada');";

    return $this->querySQL($query);
  }

  public function exists($idCli, $idPromo)
  {
    $query = "SELECT 1 FROM uso_promocion
              WHERE id_cli = $idCli AND id_promo = $idPromo
              LIMIT 1;";

    $result = $this->querySQL($query);
    return ($result && $result->num_rows > 0);
  }
}