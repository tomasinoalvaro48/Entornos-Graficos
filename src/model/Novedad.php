<?php

// Novedad.php: Clase que representa a un Objeto Novedad en el sistema (modelo de datos), 
// con sus propiedades y constructor.
// Esta clase se utiliza para mapear los datos de la tabla "Novedad" de la base de datos a objetos PHP.
// Uso substr para limitar la cantidad de caracteres

class Novedad
{
  public ?int $codNovedad;
  public string $textoNovedad;
  public ?DateTime $fechaDesdeNovedad;
  public ?DateTime $fechaHastaNovedad;
  public string $categoriaCliente;

  public function __construct(?int $codNovedad, string $textoNovedad, ?DateTime $fechaDesdeNovedad, ?DateTime $fechaHastaNovedad, string $categoriaCliente)
  {
    $this->codNovedad = $codNovedad;
    $this->textoNovedad = substr($textoNovedad, 0, 200);
    $this->fechaDesdeNovedad = $fechaDesdeNovedad;
    $this->fechaHastaNovedad = $fechaHastaNovedad;
    $this->categoriaCliente = substr($categoriaCliente, 0, 15);
  }
}
