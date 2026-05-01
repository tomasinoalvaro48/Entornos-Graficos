<?php

require_once __DIR__ . "/Local.php";
require_once __DIR__ . "/../enums.php";

class Promocion
{
  public ?int $idPromo;
  public string $textoPromo;
  public DateTime $fechaDesdePromo;
  public DateTime $fechaHastaPromo;
  public string $categoriaClientePromo;
  public ArrayObject $diasSemanaPromo;
  public string $estadoPromo;
  public Local $local;
  public ?string $estadoElimPromo;

  function __construct(
    ?int $idPromo,
    string $textoPromo,
    DateTime $fechaDesdePromo,
    DateTime $fechaHastaPromo,
    string $categoriaClientePromo,
    $diasSemanaPromo,
    string $estadoPromo,
    Local $local,
    ?string $estado_elim_promo
  ) {
    $this->idPromo = $idPromo;
    $this->textoPromo = $textoPromo;
    $this->fechaDesdePromo = $fechaDesdePromo;
    $this->fechaHastaPromo = $fechaHastaPromo;
    $this->categoriaClientePromo = $categoriaClientePromo;
    $this->diasSemanaPromo = $diasSemanaPromo;
    $this->estadoPromo = $estadoPromo;
    $this->local = $local;
    $this->estadoElimPromo = $estado_elim_promo;
  }
}