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

enum EstadoPromo: string
{
  case PENDIENTE = 'pendiente';
  case APROBADA = 'aprobada';
  case DENEGADA = 'denegada';
}

enum EstadoLocal: string
{
  case ACTIVO = 'activo';
  case ELIMINADO = 'eliminado';
}

enum EstadoElimPromo: string
{
  case ACTIVA = 'activa';
  case ELIMINADA = 'eliminada';
}

enum EstadoElimNovedad: string
{
  case ACTIVA = 'activa';
  case ELIMINADA = 'eliminada';
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

enum EstadoValidacionPromo: string
{
  case PENDIENTE = 'pendiente';
  case RECHAZADA = 'rechazada';
  case APROBADA = 'aprobada';
}

enum EstadoUsoPromo: string
{
  case PENDIENTE = 'pendiente';
  case RECHAZADA = 'rechazada';
  case APROBADA = 'aprobada';
}
