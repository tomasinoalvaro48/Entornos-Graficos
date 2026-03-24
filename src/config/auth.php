<?php

function startSession($usuario)
{
  $_SESSION['id_usuario'] = $usuario['id_usuario'];
  $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];
  $_SESSION['categoria_cliente'] = $usuario['categoria_cliente'];
}

function endSession()
{
  session_unset();
  session_destroy();
}

/*
function allowRoutes()
{
  $routes = [
    '/index.php' => [
      'page' => 'src/public/pages/menu_publico.php',
      'roles' => [] // Rutas públicas
    ],
    '/' => [
      'page' => 'src/public/pages/menu_publico.php',
      'roles' => [] // Rutas públicas
    ],
    '/menu-cliente' => [
      'page' => 'src/public/pages/menu_cliente.php',
      'roles' => ['cliente'] // Rutas para privadas
    ],
    '/menu-admin' => [
      'page' => 'src/public/pages/menu_admin.php',
      'roles' => ['admin']
    ],
    '/login' => [
      'page' => 'src/public/pages/login.php',
      'roles' => []
    ],
    '/signin' => [
      'page' => 'src/public/pages/signin.php',
      'roles' => []
    ],
  ];

  $userRole = $_SESSION['tipo_usuario'] ?? null; // null si no hay sesion de usuario
  $uri = $_SERVER['REQUEST_URI'];
  $path = parse_url($uri)['path'];

  if ($path === '/' || $path === '/index.php') {
    if ($userRole === 'cliente') {
      return $routes['/menu-cliente']['page'];
    } else if ($userRole === 'admin') {
      return $routes['/menu-admin']['page'];
    } else if ($userRole === 'dueno') {
      return $routes['/menu-dueno']['page'];
    } else if ($userRole === null) {
      return $routes['/']['page'];
    }
  }

  if (isset($routes[$path]['page'])) {
    if ($routes[$path]['roles'] === []) { // Ruta pública
      return $routes[$path]['page'];
    } else if (in_array($userRole, $routes[$path]['roles'], true)) { // Verificamos el rol
      return $routes[$path]['page'];
    }
  }

  http_response_code(404);
  return 'src/public/pages/notfound.php';
}
*/