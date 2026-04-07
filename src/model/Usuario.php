<?php

// Usuario.php: Clase que representa a un Objeto Usuario en el sistema (modelo de datos), 
// con sus propiedades y constructor.
// Esta clase se utiliza para mapear los datos de la tabla "usuario" de la base de datos a objetos PHP.

class Usuario
{
  public ?int $idUsuario;
  public string $nombreUsuario;
  public string $emailUsuario;
  public string $claveUsuario;
  public string $tipoUsuario;
  public ?string $categoriaCliente;
  public ?string $estadoDueno;

  // Constructor
  public function __construct(
    ?int $id_usuario,
    string $nombre_usuario,
    string $email_usuario,
    string $claveUsuario,
    string $tipo_usuario,
    ?string $categoria_cliente,
    ?string $estado_dueno
  ) {
    $this->idUsuario = $id_usuario;
    $this->nombreUsuario = $nombre_usuario;
    $this->emailUsuario = $email_usuario;
    $this->claveUsuario = $claveUsuario;
    $this->tipoUsuario = $tipo_usuario;
    $this->categoriaCliente = $categoria_cliente;
    $this->estadoDueno = $estado_dueno;
  }
}
