<?php

class UsoPromocion
{
  public int $idCli;
  public int $idPromo;
  public DateTime $fechaUso;
  public string $estado;

  public function __construct($idCli, $idPromo, $fechaUso, $estado)
  {
    $this->idCli = $idCli;
    $this->idPromo = $idPromo;
    $this->fechaUso = $fechaUso;
    $this->estado = $estado;
  }
}