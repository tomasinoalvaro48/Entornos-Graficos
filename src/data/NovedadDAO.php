<?php

require_once __DIR__ . "/DBFunctions.php";
require_once __DIR__ . "/../model/Novedad.php";
require_once __DIR__ . "/../enums.php";

class NovedadDAO extends DBFunctions
{
  protected function sanitizeNovedad($novedadFetchArray)
  {
    $n = null;
    if ($novedadFetchArray)
      $n = new Novedad(
        $novedadFetchArray['id_novedad'],
        $novedadFetchArray['texto_nov'],
        $novedadFetchArray['fecha_desde_nov'] ? new DateTime($novedadFetchArray['fecha_desde_nov']) : null,
        $novedadFetchArray['fecha_hasta_nov'] ? new DateTime($novedadFetchArray['fecha_hasta_nov']) : null,
        $novedadFetchArray['categoria_cliente_nov'],
        $novedadFetchArray['estado_elim_novedad'],
        $novedadFetchArray['imagen_novedad'] ?? 'default_novedad.svg'
      );
    return $n;
  }

  public function getAll()
  {
    $novedadesArray = [];
    $query = "SELECT *
              FROM novedad
              WHERE estado_elim_novedad = 'activa'
              ORDER BY fecha_desde_nov DESC";

    $novedades = $this->querySQL($query);
    if ($novedades && $novedades->num_rows > 0) {
      while ($novedad = mysqli_fetch_array($novedades)) {
        array_push($novedadesArray, $this->sanitizeNovedad($novedad));
      }
    }
    return $novedadesArray;
  }

  public function create(Novedad $novedad)
  {
    $fechaDesde = $novedad->fechaDesdeNovedad ? "'" . $novedad->fechaDesdeNovedad->format('Y-m-d') . "'" : "NULL";
    $fechaHasta = $novedad->fechaHastaNovedad ? "'" . $novedad->fechaHastaNovedad->format('Y-m-d') . "'" : "NULL";
    $query = "INSERT INTO novedad(texto_nov, fecha_desde_nov, fecha_hasta_nov, categoria_cliente_nov, estado_elim_novedad, imagen_novedad)
              VALUES ('" . $novedad->textoNovedad . "', " . $fechaDesde . ", " . $fechaHasta . ", '" . $novedad->categoriaCliente . "', '" . EstadoElimNovedad::ACTIVA->value . "', '" . $novedad->imagenNovedad . "')";
    return $this->querySQL($query);
  }

  public function logicDelete($idNovedad)
  {
    $query = "UPDATE novedad
              SET estado_elim_novedad = '" . EstadoElimNovedad::ELIMINADA->value . "'
              WHERE id_novedad = '" . $idNovedad . "';";
    return $this->querySQL($query);
  }

  /*public function delete($idNovedad)
  {
    $query = "DELETE FROM novedad WHERE id_novedad = '" . $idNovedad . "'";
    return $this->querySQL($query);
  }*/

  public function getByCategoriaCliente($categoriaCliente)
  {
    $novedadesArray = [];
    $query = "SELECT *
              FROM novedad n
              WHERE n.categoria_cliente_nov = '" . $categoriaCliente . "'
              AND n.estado_elim_novedad = 'activa'
              ORDER BY n.fecha_desde_nov DESC";
    $novedades = $this->querySQL($query);
    if ($novedades && $novedades->num_rows > 0) {
      while ($novedad = mysqli_fetch_array($novedades)) {
        array_push($novedadesArray, $this->sanitizeNovedad($novedad));
      }
    }
    return $novedadesArray;
  }

  public function getFilter($fechaDesde, $fechaHasta, $categoriaCliente)
  {
    $novedadesArray = [];

    // Base de la consulta
    $query = "SELECT *
              FROM novedad n
              WHERE n.estado_elim_novedad = 'activa' ";

    // Filtro de fechas
    if ($fechaDesde) {
      $query .= " AND n.fecha_desde_nov >= '" . $fechaDesde . "'";
    }
    if ($fechaHasta) {
      $query .= " AND n.fecha_desde_nov <= '" . $fechaHasta . "'";
    }

    // Filtro de categoría de cliente (solo para admin)
    if (!empty($categoriaCliente)) {
      $query .= " AND n.categoria_cliente_nov = '" . $categoriaCliente . "'";
    }

    $query .= " ORDER BY n.fecha_desde_nov DESC";

    $novedades = $this->querySQL($query);
    if ($novedades && $novedades->num_rows > 0) {
      while ($novedad = mysqli_fetch_array($novedades)) {
        array_push($novedadesArray, $this->sanitizeNovedad($novedad));
      }
    }
    return $novedadesArray;
  }

  public function getFilterCliente($fechaDesde, $fechaHasta, $categoriaCliente)
  {
    $novedadesArray = [];

    // Base de la consulta
    $query = "SELECT *
              FROM novedad n
              WHERE n.estado_elim_novedad = 'activa' ";

    // Filtro de fechas
    if ($fechaDesde && $fechaHasta) {
      $query .= " AND n.fecha_desde_nov >= '" . $fechaDesde . "'
                 AND n.fecha_desde_nov <= '" . $fechaHasta . "'";
    }

    // Segun categoría del cliente
    if ($categoriaCliente) {
      // Agregamos INICIAL siempre
      $query .= " AND n.categoria_cliente_nov = '" . CategoriaCliente::INICIAL->value . "'";

      // Si el cliente es REGULAR, agregamos las novedades para REGULAR
      if ($categoriaCliente === CategoriaCliente::REGULAR->value) {
        $query .= " OR (n.categoria_cliente_nov = '" . CategoriaCliente::REGULAR->value . "')";
      }

      // Si el cliente es PREMIUM, agregamos las novedades para REGULAR y PREMIUM
      if ($categoriaCliente === CategoriaCliente::PREMIUM->value) {
        $query .= " OR n.categoria_cliente_nov = '" . CategoriaCliente::REGULAR->value . "' 
                    OR n.categoria_cliente_nov = '" . CategoriaCliente::PREMIUM->value . "')";
      }
    }

    $query .= " ORDER BY n.fecha_desde_nov DESC";

    $novedades = $this->querySQL($query);
    if ($novedades && $novedades->num_rows > 0) {
      while ($novedad = mysqli_fetch_array($novedades)) {
        array_push($novedadesArray, $this->sanitizeNovedad($novedad));
      }
    }
    return $novedadesArray;
  }

  public function update(Novedad $novedad)
  {
    $fechaDesde = $novedad->fechaDesdeNovedad ? "'" . $novedad->fechaDesdeNovedad->format('Y-m-d') . "'" : "NULL";
    $fechaHasta = $novedad->fechaHastaNovedad ? "'" . $novedad->fechaHastaNovedad->format('Y-m-d') . "'" : "NULL";
    $query = "UPDATE novedad
              SET texto_nov = '" . $novedad->textoNovedad . "', fecha_desde_nov = " . $fechaDesde . ", fecha_hasta_nov = " . $fechaHasta . ", categoria_cliente_nov = '" . $novedad->categoriaCliente . "', imagen_novedad = '" . $novedad->imagenNovedad . "'
              WHERE id_novedad = '" . $novedad->codNovedad . "'";
    return $this->querySQL($query);
  }
}
