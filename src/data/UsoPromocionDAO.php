<?php

require_once __DIR__ . "/../model/UsoPromocion.php";
require_once __DIR__ . "/../model/Promocion.php";
require_once __DIR__ . "/../model/Local.php";
require_once __DIR__ . "/DBFunctions.php";

class UsoPromocionDAO extends DBFunctions
{
  protected function sanitizeUsoPromocion($usoFetchArray)
  {
    $u = null;

    if ($usoFetchArray) {
      $u = new UsoPromocion(
        $usoFetchArray['id_cli'],
        $usoFetchArray['id_promo'],
        new DateTime($usoFetchArray['fecha_uso_promo']),
        $usoFetchArray['estado_uso_promo']
      );
    }

    return $u;
  }

  public function getAll()
  {
    $usosArray = [];

    $query = "SELECT *
              FROM uso_promocion;";

    $usos = $this->querySQL($query);

    if ($usos && $usos->num_rows > 0) {
      while ($uso = mysqli_fetch_array($usos)) {
        array_push($usosArray, $this->sanitizeUsoPromocion($uso));
      }
    }

    return $usosArray;
  }

  public function getAllWithPromoAndLocal()
  {
    $usosArray = [];

    $query = "SELECT up.*, p.*, l.*
              FROM uso_promocion up
              INNER JOIN promocion p ON up.id_promo = p.id_promo
              INNER JOIN local l ON p.id_local = l.id_local;";

    $usos = $this->querySQL($query);

    if ($usos && $usos->num_rows > 0) {
      while ($row = mysqli_fetch_array($usos)) {
        $uso = $this->sanitizeUsoPromocion($row);

        $uso->promo = new Promocion(
          $row['id_promo'],
          $row['texto_promo'],
          new DateTime($row['fecha_desde_promo']),
          new DateTime($row['fecha_hasta_promo']),
          $row['categoria_cliente_promo'],
          new ArrayObject(),
          $row['estado_promo'],
          new Local(
            $row['id_local'],
            $row['ubicacion_local'],
            $row['nombre_local'],
            $row['rubro_local'],
            null,
            $row['estado_local']
          )
        );

        array_push($usosArray, $uso);
      }
    }

    return $usosArray;
  }

  public function getByCliente($idCli)
  {
    $usosArray = [];

    $query = "SELECT up.*, p.*, l.*
              FROM uso_promocion up
              INNER JOIN promocion p ON up.id_promo = p.id_promo
              INNER JOIN local l ON p.id_local = l.id_local
              WHERE up.id_cli = $idCli;";

    $usos = $this->querySQL($query);

    if ($usos && $usos->num_rows > 0) {
      while ($row = mysqli_fetch_array($usos)) {
        $uso = $this->sanitizeUsoPromocion($row);

        $uso->promo = new Promocion(
          $row['id_promo'],
          $row['texto_promo'],
          new DateTime($row['fecha_desde_promo']),
          new DateTime($row['fecha_hasta_promo']),
          $row['categoria_cliente_promo'],
          new ArrayObject(),
          $row['estado_promo'],
          new Local(
            $row['id_local'],
            $row['ubicacion_local'],
            $row['nombre_local'],
            $row['rubro_local'],
            null,
            $row['estado_local']
          )
        );

        $usosArray[] = $uso;
      }
    }

    return $usosArray;
  }

  public function getAllWithCliente()
  {
    $usosArray = [];

    $query = "SELECT up.*, usu.nombre_usuario
              FROM uso_promocion up
              INNER JOIN usuario usu ON up.id_cli = usu.id_usuario;";

    $usos = $this->querySQL($query);

    if ($usos && $usos->num_rows > 0) {
      while ($row = mysqli_fetch_array($usos)) {
        $uso = $this->sanitizeUsoPromocion($row);
        $uso->nombreCliente = $row['nombre_usuario'];
        $usosArray[] = $uso;
      }
    }

    return $usosArray;
  }

  public function updateEstado($idCli, $idPromo, $nuevoEstado)
  {
    $query = "UPDATE uso_promocion
              SET estado_uso_promo = '$nuevoEstado'
              WHERE id_cli = $idCli AND id_promo = $idPromo;";

    return $this->querySQL($query);
  }
  
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

  public function countUsosAceptadosByPromo($idPromo)
  {
    $query = "SELECT COUNT(*) as cantidad
              FROM uso_promocion
              WHERE id_promo = $idPromo
              AND estado_uso_promo = 'aceptada';";

    $usos = $this->querySQL($query);

    if ($usos && $usos->num_rows > 0) {
      $row = mysqli_fetch_array($usos);
      return (int)$row['cantidad'];
    }

    return 0;
  }

  public function exists($idCli, $idPromo)
  {
    $query = "SELECT 1 FROM uso_promocion
              WHERE id_cli = $idCli AND id_promo = $idPromo
              LIMIT 1;";

    $usos = $this->querySQL($query);
    return ($usos && $usos->num_rows > 0);
  }
}