<?php

function getRoute()
{
  $routes = [
    // Rutas públicas
    '/' => [
      'page' => 'pages/menu_cliente.php',
      'roles' => []
    ],

    '/login' => [
      'page' => 'pages/login.php',
      'roles' => []
    ],

    '/signin' => [
      'page' => 'pages/signin.php',
      'roles' => []
    ],

    // Rutas protegidas:
    // '/admin' => [
    //     'page' => 'admin.php',
    //     'roles' => ['admin']
    // ]
  ];

  $userRole = isset($_SESSION['role']) ?? null;  // Obtener roles del usuario actual (vacío si es anónimo)
  $uri = $_SERVER['REQUEST_URI'];
  $path = parse_url($uri)['path'];

  if (isset($routes[$path]['page'])) {
    if ($routes[$path]['roles'] === []) {
      return $routes[$path]['page'];
    }

    if (in_array($userRole, $routes[$path]['roles'], true)) {
      return $routes[$path]['page'];
    }
  }
  return 'pages/notfound.php';
}
