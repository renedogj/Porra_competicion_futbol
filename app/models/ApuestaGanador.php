<?php

class ApuestaGanador { 
  public static function obtenerApuestas() {
    global $db;

    $sql = "SELECT 
      personas.id,
      personas.nombre,
      paises_1.nombre as puesto_1,
      paises_2.nombre as puesto_2,
      paises_3.nombre as puesto_3,
      paises_4.nombre as puesto_4,
      apuestas_clasificacion.puntuacion
      FROM apuestas_clasificacion
      LEFT JOIN paises as paises_1
      ON apuestas_clasificacion.puesto_1 = paises_1.id
      LEFT JOIN paises as paises_2
      ON apuestas_clasificacion.puesto_2 = paises_2.id
      LEFT JOIN paises as paises_3
      ON apuestas_clasificacion.puesto_3 = paises_3.id
      LEFT JOIN paises as paises_4
      ON apuestas_clasificacion.puesto_4 = paises_4.id
      LEFT JOIN personas as personas
      ON apuestas_clasificacion.id_persona = personas.id";

    $json = [];

    $json["clasificatoria"] = obtenerArraySQL($db, $sql);
    $json["id"] = $_SESSION["id"];

    return $json;
  }

  public static function obtenerApuestaUsuario() {
    if(isset($_SESSION["token"]) && isset($_SESSION["id"])){
      $token = $_SESSION["token"];
      $id = $_SESSION["id"];

      global $db;

      $sql = "SELECT id FROM personas WHERE user_token = ?";

      if(obtenerArraySQL($db, $sql, [$token])[0]["id"] == $id){
        $sql = "SELECT 
          puesto_1,
          puesto_2,
          puesto_3,
          puesto_4 
          from apuestas_clasificacion
          where id_persona = ?";

        $array = obtenerArraySQL($db, $sql, [$id]);

        return $array;
      }else{
        header('HTTP/1.1 401 Unauthorized', true, 401);
      }
    }else{
      header('HTTP/1.1 401 Unauthorized', true, 401);
    }
  }

  
  public static function apostar() {
    global $db;

    if (!isset($_SESSION["id"]) || !isset($_POST["puesto_1"]) || !isset($_POST["puesto_2"])) {
      echo json_encode(["error" => true, "message" => "Faltan parámetros requeridos."]);
      return;
    }

    $id = $_SESSION["id"];
    $puesto_1 = $_POST["puesto_1"];
    $puesto_2 = $_POST["puesto_2"];

    $json = [];
    try {
      $sql = "INSERT INTO apuestas_clasificacion (id_persona, puesto_1, puesto_2) 
              VALUES (:id_persona, :puesto_1, :puesto_2)
              ON DUPLICATE KEY UPDATE puesto_1 = VALUES(puesto_1), puesto_2 = VALUES(puesto_2)";

      obtenerArraySQL($db, $sql, [
        ':id_persona' => $id,
        ':puesto_1' => $puesto_1,
        ':puesto_2' => $puesto_2
      ]);

      $json["error"] = false;
    } catch(PDOException $e) {
      $json["error"] = true;
      $json["message"] = "Ha ocurrido un error en la base de datos al guardar la apuesta.";
    }
    return $json;

  }
}

?>