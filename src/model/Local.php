<?php
require_once __DIR__ . "/../enums.php";

class Local
{
  public ?int $idLocal;
  public string $ubiLocal;
  public string $nombreLocal;
  public string $rubroLocal;
  public ?Usuario $usuario;
  public ?string $estadoLocal;
  public ?array $promociones;
  public string $imagenLocal;


  function __construct(
    ?int $id_local,
    string $ubicacion_local,
    string $nombre_local,
    string $rubro_local,
    ?Usuario $usuario,
    ?string $estado_elim_local,
    string $imagen_local,
    ?array $promociones = null

  ) {
    $this->idLocal = $id_local;
    $this->ubiLocal = $ubicacion_local;
    $this->nombreLocal = $nombre_local;
    $this->rubroLocal = $rubro_local;
    $this->usuario = $usuario;
    $this->estadoLocal = $estado_elim_local;
    $this->promociones = $promociones;
    $this->imagenLocal = $imagen_local;
  }
}
