<?php

class Usuario
{
  public $id_usuario;
  public $nombre_usuario;
  public $email_usuario;
  public $clave_usuario;
  public $tipo_usuario;
  public $categoria_cliente;

  public function __construct($id_usuario, $nombre_usuario, $email_usuario, $clave_usuario, $tipo_usuario, $categoria_cliente)
  {
    $this->id_usuario = $id_usuario;
    $this->nombre_usuario = $nombre_usuario;
    $this->email_usuario = $email_usuario;
    $this->clave_usuario = $clave_usuario;
    $this->tipo_usuario = $tipo_usuario;
    $this->categoria_cliente = $categoria_cliente;
  }
}
