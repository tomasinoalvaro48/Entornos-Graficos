<?php


enum TipoUsuario: string
{
  case CLIENTE = 'cliente';
  case DUENO = 'dueno';
  case ADMIN = 'administrador';
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
