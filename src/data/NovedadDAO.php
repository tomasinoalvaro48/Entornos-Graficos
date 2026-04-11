<?php
require_once __DIR__ . "/DBFunctions.php";
require_once __DIR__ . "/../model/Novedad.php";
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
        $novedadFetchArray['tipo_cliente_nov'],
      );
    return $n;
  }

  public function getAll()
  {
    $novedadesArray = [];
    $query = 'SELECT * FROM novedad';
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
    $query = "INSERT INTO novedad(texto_nov, fecha_desde_nov, fecha_hasta_nov, tipo_cliente_nov) VALUES ('" . $novedad->textoNovedad . "', " . $fechaDesde . ", " . $fechaHasta . ", '" . $novedad->tipoCliente . "')";
    return $this->querySQL($query);
  }

  public function delete($idNovedad)
  {
    $query = "DELETE FROM novedad WHERE id_novedad = '" . $idNovedad . "'";
    return $this->querySQL($query);
  }

  public function getByType() {}

  public function update(Novedad $novedad) {}
}
