<?php

require_once __DIR__ . "/../model/Promocion.php";
require_once __DIR__ . "/../model/Local.php";
require_once __DIR__ . "/DBFunctions.php";

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
        new ArrayObject(),
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

  public function create(Promocion $p)
  {
    $query = "INSERT INTO promocion 
    (texto_promo, fecha_desde_promo, fecha_hasta_promo, categoria_cliente_promo, estado_promo, id_local)
    VALUES (
      '{$p->textoPromo}',
      '{$p->fechaDesdePromo->format('Y-m-d')}',
      '{$p->fechaHastaProm->format('Y-m-d')}',
      '{$p->categoriaClientePromo}',
      '{$p->estadoPromo}',
      {$p->local->idLocal}
    );";

    $this->querySQL($query);

    $queryId = "SELECT MAX(id_promo) as id FROM promocion;";
    $result = $this->querySQL($queryId);
    $row = mysqli_fetch_array($result);
    $idPromo = $row['id'];

    foreach ($p->diasSemanaPromo as $dia) {
      $queryDia = "INSERT INTO dias_promo (id_dia, id_promo)
                  VALUES ($dia, $idPromo);";
      $this->querySQL($queryDia);
    }

    return true;
  }
}