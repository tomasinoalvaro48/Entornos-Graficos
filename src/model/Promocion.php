<?php

require_once __DIR__ . "/Local.php";

class Promocion
{
  public ?int $idPromo;
  public string $textoPromo;
  public DateTime $fechaDesdePromo;
  public DateTime $fechaHastaProm;
  public string $categoriaClientePromo;
  public ArrayObject $diasSemanaPromo;
  public string $estadoPromo;
  public Local $local;
}
