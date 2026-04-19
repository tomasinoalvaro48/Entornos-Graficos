<?php

class Local
{
  public ?int $idLocal;
  public string $ubiLocal;
  public string $nombreLocal;
  public string $rubroLocal;
  public ?Usuario $usuario;
  public ?string $estadoLocal;


  function __construct(
    ?int $id_local,
    string $ubicacion_local,
    string $nombre_local,
    string $rubro_local,
    ?Usuario $usuario,

  ) {
    $this->idLocal = $id_local;
    $this->ubiLocal = $ubicacion_local;
    $this->nombreLocal = $nombre_local;
    $this->rubroLocal = $rubro_local;
    $this->usuario = $usuario;
    $this->estadoLocal =  'activo';
  }
}
