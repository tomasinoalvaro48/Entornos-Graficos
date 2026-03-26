<?php

class Usuario
{
  public ?int $idUsuario;
  public string $nombreUsuario;
  public string $emailUsuario;
  public string $claveUsuario;
  public string $tipoUsuario;
  public string $categoriaCliente;

  public function __construct($id_usuario, $nombre_usuario, $email_usuario, $claveUsuario, $tipo_usuario, $categoria_cliente)
  {
    $this->idUsuario = $id_usuario;
    $this->nombreUsuario = $nombre_usuario;
    $this->emailUsuario = $email_usuario;
    $this->claveUsuario = $claveUsuario;
    $this->tipoUsuario = $tipo_usuario;
    $this->categoriaCliente = $categoria_cliente;
  }
}
