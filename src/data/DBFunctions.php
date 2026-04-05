<?php

// DBFunctions.php: Clase base para manejar la conexión a la base de datos y ejecutar consultas SQL.

require_once __DIR__ . "/../../env.php";

class DBFunctions
{
  protected $DB_HOSTNAME = DB_HOSTNAME;
  protected $DB_USERNAME = DB_USERNAME;
  protected $DB_PASSWORD = DB_PASSWORD;
  protected $DB_NAME = DB_NAME;
  protected $DB_PORT = DB_PORT;

  // Función para ejecutar una consulta SQL y devolver el resultado (usada por los DAOs)
  public function querySQL($query)
  {
    $link = mysqli_connect($this->DB_HOSTNAME, $this->DB_USERNAME, $this->DB_PASSWORD, $this->DB_NAME);

    if (!$link) {
      die("Error de conexión: " . mysqli_connect_error());
    }

    $resultado = mysqli_query($link, $query);
    mysqli_close($link);
    return $resultado;
  }
}
