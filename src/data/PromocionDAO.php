<?php

require_once __DIR__ . "/../model/Promocion.php";
require_once __DIR__ . "/../model/Local.php";
require_once __DIR__ . "/../model/Usuario.php";
require_once __DIR__ . "/DBFunctions.php";
require_once __DIR__ . "/../enums.php";

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
          new Usuario(
            $promocionFetchArray['id_usuario'],
            $promocionFetchArray['nombre_usuario'],
            $promocionFetchArray['email_usuario'],
            $promocionFetchArray['clave_usuario'],
            $promocionFetchArray['tipo_usuario'],
            $promocionFetchArray['categoria_cliente'],
            $promocionFetchArray['estado_dueno'],
            $promocionFetchArray['estado_mail'],
            $promocionFetchArray['token_verificacion']
          ),
          $promocionFetchArray['estado_elim_local']
        ),
        $promocionFetchArray['estado_elim_promo']
      );
    }
    return $p;
  }

  public function getAll()
  {
    $promocionesArray = [];

    $query = "SELECT *
              FROM promocion p
              INNER JOIN local l ON p.id_local = l.id_local
              INNER JOIN usuario u ON l.id_usuario = u.id_usuario
              WHERE p.estado_elim_promo = 'activa';";

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

  public function getById($idPromo)
  {
    $p = null;

    $query = "SELECT *
              FROM promocion p
              INNER JOIN local l ON p.id_local = l.id_local
              INNER JOIN usuario u ON l.id_usuario = u.id_usuario
              WHERE p.id_promo = '" . $idPromo . "'
              AND p.estado_elim_promo = 'activa';";

    $promocion = $this->querySQL($query);

    if ($promocion && $promocion->num_rows > 0) {
      $promo = mysqli_fetch_array($promocion);
      $p = $this->sanitizePromocion($promo);

      $dias = [];
      $diasQuery = "SELECT id_dia
                    FROM dias_promo
                    WHERE id_promo = " . $promo['id_promo'];
      $diasPromocion = $this->querySQL($diasQuery);

      if ($diasPromocion && $diasPromocion->num_rows > 0) {
        while ($d = mysqli_fetch_array($diasPromocion)) {
          $dias[] = $d['id_dia'];
        }
      }

      $p->diasSemanaPromo = new ArrayObject($dias);
    }

    return $p;
  }

  public function getByLocalId($idLocal)
  {
    $promocionesArray = [];

    $query = "SELECT *
              FROM promocion p
              INNER JOIN local l ON p.id_local = l.id_local
              INNER JOIN usuario u ON l.id_usuario = u.id_usuario
              WHERE p.id_local = '" . $idLocal . "'
              AND p.estado_elim_promo = 'activa';";

    $result = $this->querySQL($query);

    if ($result && $result->num_rows > 0) {
      while ($row = mysqli_fetch_array($result)) {
        $p = $this->sanitizePromocion($row);

        $dias = [];
        $diasQuery = "SELECT id_dia
                      FROM dias_promo
                      WHERE id_promo = " . $row['id_promo'];
        $diasResult = $this->querySQL($diasQuery);

        while ($d = mysqli_fetch_array($diasResult)) {
          $dias[] = $d['id_dia'];
        }

        $p->diasSemanaPromo = new ArrayObject($dias);

        $promocionesArray[] = $p;
      }
    }

    return $promocionesArray;
  }

  function getCategoriasPermitidas($categoriaCliente)
  {
    return match (strtolower($categoriaCliente)) {
      'premium' => ['inicial', 'medium', 'premium'],
      'medium' => ['inicial', 'medium'],
      'inicial' => ['inicial'],
      default => []
    };
  }

  public function getPromosValidasParaCliente($idLocal, $categoriaCliente)
  {
    $hoy = date('Y-m-d');
    $diaHoy = date('N');

    $categorias = $this->getCategoriasPermitidas($categoriaCliente);
    $categoriasSQL = "'" . implode("','", $categorias) . "'";

    $query = "SELECT DISTINCT p.*, l.*, u.*
              FROM promocion p
              INNER JOIN local l ON p.id_local = l.id_local
              INNER JOIN usuario u ON l.id_usuario = u.id_usuario
              INNER JOIN dias_promo dp ON p.id_promo = dp.id_promo
              WHERE p.id_local = $idLocal
                AND p.estado_promo = 'aprobada'
                AND p.fecha_desde_promo <= '$hoy'
                AND p.fecha_hasta_promo >= '$hoy'
                AND LOWER(p.categoria_cliente_promo) IN ($categoriasSQL)
                AND dp.id_dia = $diaHoy
                AND p.estado_elim_promo = 'activa';";

    $result = $this->querySQL($query);

    $promocionesArray = [];

    if ($result && $result->num_rows > 0) {
      while ($row = mysqli_fetch_array($result)) {
        $p = $this->sanitizePromocion($row);

        $dias = [];
        $diasQuery = "SELECT id_dia
                      FROM dias_promo
                      WHERE id_promo = " . $row['id_promo'];
        $diasResult = $this->querySQL($diasQuery);

        while ($d = mysqli_fetch_array($diasResult)) {
          $dias[] = $d['id_dia'];
        }

        $p->diasSemanaPromo = new ArrayObject($dias);

        $promocionesArray[] = $p;
      }
    }

    return $promocionesArray;
  }

  public function getFilter($fechaDesde, $fechaHasta, $categoriaCliente, $estadoPromo, $idLocal, $dia)
  {
    $promocionesArray = [];

    $query = "SELECT DISTINCT p.*, l.*, u.*
              FROM promocion p
              INNER JOIN local l ON p.id_local = l.id_local
              INNER JOIN usuario u ON l.id_usuario = u.id_usuario
              LEFT JOIN dias_promo dp ON p.id_promo = dp.id_promo
              WHERE 1=1
              AND p.estado_elim_promo = 'activa' ";

    if ($fechaDesde && $fechaHasta) {
      $query .= " AND p.fecha_desde_promo >= '" . $fechaDesde . "'";
      $query .= " AND p.fecha_desde_promo <= '" . $fechaHasta . "'";
    }

    if (!empty($categoriaCliente)) {
      if (getTipoUsuario() === TipoUsuario::DUENO->value) {
        $query .= " AND LOWER(p.categoria_cliente_promo) = '" . strtolower($categoriaCliente) . "'";
      } else {
        $categorias = $this->getCategoriasPermitidas($categoriaCliente);
        $categoriasSQL = "'" . implode("','", $categorias) . "'";
        $query .= " AND LOWER(p.categoria_cliente_promo) IN ($categoriasSQL)";
      }
    }

    if (!empty($estadoPromo)) {
      $query .= " AND p.estado_promo = '$estadoPromo'";
    }

    if (!empty($idLocal)) {
      $query .= " AND p.id_local = '$idLocal'";
    }

    if (!empty($dia)) {
      $query .= " AND dp.id_dia = '$dia'";
    }

    $query .= " ORDER BY p.fecha_desde_promo DESC";

    $promociones = $this->querySQL($query);

    if ($promociones && $promociones->num_rows > 0) {
      while ($row = mysqli_fetch_array($promociones)) {
        $p = $this->sanitizePromocion($row);

        $dias = [];
        $diasQuery = "SELECT id_dia
                      FROM dias_promo
                      WHERE id_promo = " . $row['id_promo'];
        $diasPromocion = $this->querySQL($diasQuery);

        if ($diasPromocion && $diasPromocion->num_rows > 0) {
          while ($d = mysqli_fetch_array($diasPromocion)) {
            $dias[] = $d['id_dia'];
          }
        }

        $p->diasSemanaPromo = new ArrayObject($dias);

        array_push($promocionesArray, $p);
      }
    }

    return $promocionesArray;
  }

  public function getFilterAdminPromociones($nombreLocal, $estadoPromo)
  {
    $promocionesArray = [];

    $query = "SELECT DISTINCT p.*, l.*, u.*
              FROM promocion p
              INNER JOIN local l ON p.id_local = l.id_local
              INNER JOIN usuario u ON l.id_usuario = u.id_usuario
              LEFT JOIN dias_promo dp ON p.id_promo = dp.id_promo
              WHERE 1=1
              AND p.estado_elim_promo = '" . EstadoElimPromo::ACTIVA->value . "' ";

    if (!empty($nombreLocal)) {
      $query .= " AND l.nombre_local LIKE '%" . $nombreLocal . "%'";
    }

    if (!empty($estadoPromo)) {
      $query .= " AND p.estado_promo = '" . $estadoPromo . "'";
    }

    $query .= " ORDER BY p.fecha_desde_promo DESC";

    $promociones = $this->querySQL($query);

    if ($promociones && $promociones->num_rows > 0) {
      while ($row = mysqli_fetch_array($promociones)) {
        $p = $this->sanitizePromocion($row);

        $dias = [];
        $diasQuery = "SELECT id_dia
                      FROM dias_promo
                      WHERE id_promo = " . $row['id_promo'];
        $diasPromocion = $this->querySQL($diasQuery);

        if ($diasPromocion && $diasPromocion->num_rows > 0) {
          while ($d = mysqli_fetch_array($diasPromocion)) {
            $dias[] = $d['id_dia'];
          }
        }

        $p->diasSemanaPromo = new ArrayObject($dias);

        array_push($promocionesArray, $p);
      }
    }

    return $promocionesArray;
  }

  public function create(Promocion $p)
  {
    $query = "INSERT INTO promocion 
    (texto_promo, fecha_desde_promo, fecha_hasta_promo, categoria_cliente_promo, estado_promo, id_local, estado_elim_promo)
    VALUES (
      '{$p->textoPromo}',
      '{$p->fechaDesdePromo->format('Y-m-d')}',
      '{$p->fechaHastaPromo->format('Y-m-d')}',
      '{$p->categoriaClientePromo}',
      '{$p->estadoPromo}',
      {$p->local->idLocal},
      '" . EstadoElimPromo::ACTIVA->value . "'
    );";

    $this->querySQL($query);

    $queryId = "SELECT MAX(id_promo) as id
                FROM promocion;";
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

  public function updateEstadoPromo($idPromo, $nuevoEstado)
  {
    $query = "UPDATE promocion
              SET estado_promo = '" . $nuevoEstado . "'
              WHERE id_promo = '" . (int)$idPromo . "';";
    return $this->querySQL($query);
  }

  public function logicDelete($id)
  {
    $query = "UPDATE promocion
              SET estado_elim_promo = '" . EstadoElimPromo::ELIMINADA->value . "'
              WHERE id_promo = '" . $id . "';";
    return $this->querySQL($query);
  }

  /*public function delete($id)
  {
    $queryDias = "DELETE FROM dias_promo
                  WHERE id_promo = '" . $id . "';";
    $this->querySQL($queryDias);

    $query = "DELETE FROM promocion
              WHERE id_promo = '" . $id . "';";
    return $this->querySQL($query);
  }*/
}
