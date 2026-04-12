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
        new DateTime($promocionFetchArray['fecha_desde_promo']),
        new DateTime($promocionFetchArray['fecha_hasta_promo']),
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

  public function getAll()
  {
    $promocionesArray = [];

    $query = "SELECT *
              FROM promocion p
              INNER JOIN local l ON p.id_local = l.id_local;";

    $promociones = $this->querySQL($query);

    if ($promociones && $promociones->num_rows > 0) {
      while ($promocion = mysqli_fetch_array($promociones)) {
        $p = $this->sanitizePromocion($promocion);

        $dias = [];
        $diasQuery = "SELECT id_dia
                      FROM dias_promo
                      WHERE id_promo = " . $promocion['id_promo'];
        $diasResult = $this->querySQL($diasQuery);

        if ($diasResult && $diasResult->num_rows > 0) {
          while ($d = mysqli_fetch_array($diasResult)) {
            $dias[] = $d['id_dia'];
          }
        }

        $p->diasSemanaPromo = new ArrayObject($dias);

        array_push($promocionesArray, $p);
      }
    }

    return $promocionesArray;
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
      '{$p->fechaHastaPromo->format('Y-m-d')}',
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

  public function delete($id)
  {
    $queryDias = "DELETE FROM dias_promo
                  WHERE id_promo = '" . $id . "';";
    $this->querySQL($queryDias);

    $query = "DELETE FROM promocion
              WHERE id_promo = '" . $id . "';";
    return $this->querySQL($query);
  }
}