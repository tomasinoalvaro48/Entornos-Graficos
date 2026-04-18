<?php

// DBFunctions.php: Clase base para manejar la conexion a la base de datos y ejecutar consultas SQL.

require_once __DIR__ . "/../config/env.php";

class DBFunctions
{
  // Función para ejecutar una consulta SQL y devolver el resultado (usada por los DAOs)
  public function querySQL($query)
  {
    $link = mysqli_connect($_ENV['DB_HOSTNAME'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], $_ENV['DB_NAME']);

    if (!$link) {
      die("Error de conexión: " . mysqli_connect_error());
    }

    $resultado = mysqli_query($link, $query);
    mysqli_close($link);
    return $resultado;
  }
}
