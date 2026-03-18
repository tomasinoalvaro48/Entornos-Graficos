<?php

function allowRoutes()
{
  $routes = [
    // Rutas públicas
    '/' => [
      'page' => 'pages/menu_publico.php',
      'roles' => []
    ],

    '/menu-cliente' => [
      'page' => 'pages/menu_cliente.php',
      'roles' => ['cliente']
    ],

    '/menu-admin' => [
      'page' => 'pages/menu_admin.php',
      'roles' => ['admin']
    ],

    '/login' => [
      'page' => 'pages/login.php',
      'roles' => []
    ],

    '/signin' => [
      'page' => 'pages/signin.php',
      'roles' => []
    ],
  ];

  $userRole = $_SESSION['role'] ?? null; // null si no hay sesion de usuario
  $uri = $_SERVER['REQUEST_URI'] ?? '/';
  $path = parse_url($uri)['path'] ?? '/';

  if ($path === '' || $path === '/index.php') {
    $path = '/';
  }

  if (isset($routes[$path]['page'])) {
    if ($routes[$path]['roles'] === []) {
      return $routes[$path]['page'];
    } else if (in_array($userRole, $routes[$path]['roles'], true)) {
      return $routes[$path]['page'];
    }
  }

  http_response_code(404);
  return 'pages/notfound.php';
}
