<?php

class Paises { 
  public static function obtenerPaises() {
    global $db;

    $sql = "SELECT id, nombre, abreviatura, grupo from paises order by grupo";

    return obtenerArraySQL($db, $sql);
  }
}

?>