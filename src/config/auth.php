<?php 

function authPages($page) { // hacer que el rol se obtenga por sesión
  $publicPages = [ // páginas públicas
    "login.php",
    "signin.php",
    "menu_cliente.php"
  ];

  $pagesByRole = [ // páginas por rol
    "admin" => ["menuAdmin.php"],
    "dueno" => ["menuDueno.php"],
    "cliente" => ["menu_cliente.php"]
  ];

  $unauthorizedPage = "pages/unathorized.php";
  $role = $_SESSION['role'] ?? null;

  if (!$page) {
    return $unauthorizedPage;
  }

  if (!$role && !in_array($page, $publicPages)) { // si no hay rol o el rol no es válido, denegar acceso
    return $unauthorizedPage;
  }

  if ($role && !in_array($page, $pagesByRole[$role])) { // si hay rol pero la página no es accesible para ese rol, denegar acceso
    return $unauthorizedPage;
  }

  return "pages/$page";
}



?>