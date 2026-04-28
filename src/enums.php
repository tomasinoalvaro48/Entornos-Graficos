<?php

define('NUM_ITEMS_BY_PAGE', 6);

enum TipoUsuario: string
{
  case CLIENTE = 'cliente';
  case DUENO = 'dueno';
  case ADMIN = 'admin';
}

enum CategoriaCliente: string
{
  case INICIAL = 'inicial';
  case REGULAR = 'medium';
  case PREMIUM = 'premium';
}

enum EstadoLocal: string
{
  case ACTIVO = 'Activo';
  case ELIMINADO = 'Eliminado';
}

enum EstadoMail: string
{
  case CONFIRMADO = 'confirmado';
  case NO_CONFIRMADO = 'no_confirmado';
}

enum EstadoDueno: string
{
  case PENDIENTE = 'pendiente';
  case RECHAZADO = 'rechazado';
  case ACEPTADO = 'aceptado';
}
