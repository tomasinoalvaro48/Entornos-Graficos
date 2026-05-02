<?php

require_once __DIR__ . "/../model/Local.php";
require_once __DIR__ . "/../model/Promocion.php";
require_once __DIR__ . "/../model/Usuario.php";
require_once __DIR__ . "/DBFunctions.php";
require_once __DIR__ . "/../enums.php";

class LocalDAO extends DBFunctions
{
  // Función para convertir un array de resultado de la base de datos en un objeto Local
  protected function sanitizeLocal($localFetchArray)
  {
    $l = null;
    if ($localFetchArray) {
      $l = new Local(
        $localFetchArray['id_local'],
        $localFetchArray['ubicacion_local'],
        $localFetchArray['nombre_local'],
        $localFetchArray['rubro_local'],
        new Usuario(
          $localFetchArray['id_usuario'],
          $localFetchArray['nombre_usuario'],
          $localFetchArray['email_usuario'],
          $localFetchArray['clave_usuario'],
          $localFetchArray['tipo_usuario'],
          $localFetchArray['categoria_cliente'],
          $localFetchArray['estado_dueno'],
          $localFetchArray['estado_mail'],
          $localFetchArray['token_verificacion']
        ),
        $localFetchArray['estado_elim_local']
      );
    }
    return $l;
  }

  public function getAll()
  {
    $localesArray = [];
    $query = "SELECT * FROM local INNER JOIN usuario ON usuario.id_usuario = local.id_usuario;";
    $locales = $this->querySQL($query);
    if ($locales && $locales->num_rows > 0) {
      while ($local = mysqli_fetch_array($locales)) {
        array_push($localesArray, $this->sanitizeLocal($local));
      }
    }
    return $localesArray;
  }

  public function getFilter($nombre, $rubro, $estado, $idUsuario = null)
  {
    $localesArray = [];

    // Base de la consulta
    $query = "SELECT *
              FROM local l
              INNER JOIN usuario u ON u.id_usuario = l.id_usuario
              WHERE 1=1";

    if (!empty($nombre)) {
      $query .= " AND l.nombre_local LIKE '%" . $nombre . "%'";
    }

    if (!empty($rubro)) {
      $query .= " AND l.rubro_local LIKE '%" . $rubro . "%'";
    }

    if (!empty($estado)) {
      $query .= " AND l.estado_elim_local = '" . $estado . "'";
    }

    if (!empty($idUsuario)) {
      $query .= " AND l.id_usuario = " . $idUsuario;
    }

    $locales = $this->querySQL($query);

    if ($locales && $locales->num_rows > 0) {
      while ($local = mysqli_fetch_array($locales)) {
        array_push($localesArray, $this->sanitizeLocal($local));
      }
    }
    return $localesArray;
  }

  public function getByNombre(string $nombre)
  {
    $l = null;
    $query = "SELECT * FROM local INNER JOIN usuario ON usuario.id_usuario = local.id_usuario 
              WHERE local.nombre_local LIKE '%$nombre%';";
    $local = $this->querySQL($query);
    if ($local && $local->num_rows > 0) {
      $l = $this->sanitizeLocal(mysqli_fetch_array($local));
    }
    return $l;
  }

  public function getById($id)
  {
    $l = null;
    $query = "SELECT * FROM local INNER JOIN usuario ON usuario.id_usuario = local.id_usuario 
              WHERE id_local = '" . $id . "';";
    $local = $this->querySQL($query);
    if ($local && $local->num_rows > 0) {
      $l = $this->sanitizeLocal(mysqli_fetch_array($local));
    }
    return $l;
  }

  public function getByRubro($rubro)
  {
    $localesArray = [];

    $query = "SELECT *
              FROM local
              INNER JOIN usuario ON usuario.id_usuario = local.id_usuario
              WHERE local.rubro_local = '$rubro'
                AND local.estado_elim_local = 'activo';";

    $result = $this->querySQL($query);

    if ($result && $result->num_rows > 0) {
      while ($row = mysqli_fetch_array($result)) {
        $localesArray[] = $this->sanitizeLocal($row);
      }
    }

    return $localesArray;
  }

  public function searchLocalesPromocionesByName($nombreBusqueda)
  {
    $localesById = [];

    $queryLocales = "SELECT l.*, u.*
                    FROM local l
                    INNER JOIN usuario u ON u.id_usuario = l.id_usuario
                    WHERE l.estado_elim_local = '" . EstadoLocal::ACTIVO->value . "'
                      AND LOWER(l.nombre_local) LIKE '%" . $nombreBusqueda . "%';";

    $locales = $this->querySQL($queryLocales);

    if ($locales && $locales->num_rows > 0) {
      while ($row = mysqli_fetch_array($locales)) {
        $localId = $row['id_local'];

        if (!isset($localesById[$localId])) {
          $local = $this->sanitizeLocal($row);
          $local->promociones = [];
          $localesById[$localId] = $local;
        }
      }
    }

    $queryPromos = "SELECT p.*, l.*, u.*
                    FROM promocion p
                    INNER JOIN local l ON p.id_local = l.id_local
                    INNER JOIN usuario u ON l.id_usuario = u.id_usuario
                    WHERE p.estado_elim_promo = '" . EstadoElimPromo::ACTIVA->value . "'
                      AND p.estado_promo = '" . EstadoPromo::APROBADA->value . "'
                      AND l.estado_elim_local = '" . EstadoLocal::ACTIVO->value . "'
                      AND LOWER(p.texto_promo) LIKE '%" . $nombreBusqueda . "%';";

    $promos = $this->querySQL($queryPromos);

    if ($promos && $promos->num_rows > 0) {
      while ($row = mysqli_fetch_array($promos)) {
        $localId = $row['id_local'];

        if (!isset($localesById[$localId])) {
          $local = $this->sanitizeLocal($row);
          $local->promociones = [];
          $localesById[$localId] = $local;
        }

        $promo = new Promocion(
          $row['id_promo'],
          $row['texto_promo'],
          new DateTime($row['fecha_desde_promo']),
          new DateTime($row['fecha_hasta_promo']),
          $row['categoria_cliente_promo'],
          new ArrayObject(),
          $row['estado_promo'],
          $localesById[$localId],
          $row['estado_elim_promo']
        );

        $localesById[$localId]->promociones[] = $promo;
      }
    }

    return array_values($localesById);
  }

  public function create(Local $local)
  {
    $query = "INSERT INTO local (ubicacion_local, nombre_local, rubro_local, id_usuario, estado_elim_local) VALUES 
            ('" . $local->ubiLocal . "', '" . $local->nombreLocal . "', '" . $local->rubroLocal . "', 
            " . $local->usuario->idUsuario . ", '" . EstadoLocal::ACTIVO->value . "');";
    return $this->querySQL($query);
  }

  public function update(Local $local)
  {
    $query = "UPDATE local SET ubicacion_local = '" . $local->ubiLocal . "', nombre_local = '" . $local->nombreLocal . "',
              rubro_local = '" . $local->rubroLocal . "', id_usuario = " . $local->usuario->idUsuario . ", estado_elim_local = '" . $local->estadoLocal . "'
              WHERE id_local = " . $local->idLocal . ";";
    return $this->querySQL($query);
  }

  public function logicDelete($id)
  {
    $query = "UPDATE local SET estado_elim_local = '" . EstadoLocal::ELIMINADO->value . "' WHERE id_local = '" . $id . "';";
    return $this->querySQL($query);
  }

  public function delete($id)
  {
    $query = "DELETE FROM local WHERE id_local = '" . $id . "';";
    return $this->querySQL($query);
  }
}
