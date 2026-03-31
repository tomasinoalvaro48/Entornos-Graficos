<?php

class PromocionDAO extends DBFunctions
{

  protected function sanitizePromocion($promocionFetchArray)
  {
    $p = null;
    if ($promocionFetchArray) {
      $p = new Promocion(
        $promocionFetchArray['id_promo'],
        $promocionFetchArray['texto_promo'],
        $promocionFetchArray['fecha_desde_promo'],
        $promocionFetchArray['fecha_hasta_promo'],
        $promocionFetchArray['categoria_cliente_promo'],
        $promocionFetchArray['estado_promo'],
        new Local(
          $promocionFetchArray['id_local'],
          $promocionFetchArray['ubicacion_local'],
          $promocionFetchArray['nombre_local'],
          $promocionFetchArray['rubro_local'],
          null
        )
      );
    }
    return $p;
  }

  public function getByLocalId($idLocal)
  {
    $p = null;
    $query = "SELECT * FROM promocion WHERE id_local = '" . $idLocal . "';";
    $promocion = $this->querySQL($query);
    if ($promocion && $promocion->num_rows > 0) {
      $p = $this->sanitizePromocion(mysqli_fetch_array($promocion));
    }
    return $p;
  }
}
