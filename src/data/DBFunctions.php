<?php
require_once "../../env.php";

class DBFunctions
{
  public function querySQL($query)
  {
    global $DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_NAME;
    $link = mysqli_connect($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

    if (!$link) {
      die("Error de conexión: " . mysqli_connect_error());
    }

    $resultado = mysqli_query($link, $query);
    mysqli_close($link);
    return $resultado;
  }
}
