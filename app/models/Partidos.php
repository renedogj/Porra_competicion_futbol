<?php

class Partidos { 
  public static function obtenerPartidosApuestas() {
    global $db;

    $id = $_SESSION["id"];

    $sql = "SELECT 
      partidos.id,
      DATE_FORMAT(partidos.fecha, '%d-%m-%Y %H:%i') as fecha,
      paises_1.nombre as nombre_1,
      paises_1.abreviatura as abreviatura_1,
      paises_1.grupo as grupo_1,
      paises_2.nombre as nombre_2,
      paises_2.abreviatura as abreviatura_2,
      paises_2.grupo as grupo_2,
      resultado_1,
      resultado_2,
      apuesta_1,
      apuesta_2,
      partidos.ganador,
      puntuacion,
      faseGrupos
      FROM partidos
      LEFT JOIN paises as paises_1
      ON partidos.id_pais_1 = paises_1.id
      LEFT JOIN paises as paises_2
      ON partidos.id_pais_2 = paises_2.id
      LEFT JOIN apuestas
      ON partidos.id = apuestas.id_partido and apuestas.id_persona= ?
      ORDER BY fecha";

    $stmt = $db->prepare($sql);
    $stmt->execute([$id]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function obtenerPartido() {
    global $db;

    $id = $_SESSION["id"];
    $idPartido = $_POST["idPartido"];

    $sql = "SELECT 
      partidos.id,
      partidos.fecha,
      paises_1.nombre as nombre_1,
      paises_1.abreviatura as abreviatura_1,
      paises_2.nombre as nombre_2,
      paises_2.abreviatura as abreviatura_2,
      resultado_1,
      resultado_2,
      apuestas.id as idApuesta,
      apuesta_1,
      apuesta_2,
      faseGrupos,
      apuestas.ganador as ganador
      FROM partidos
      LEFT JOIN paises as paises_1
      ON partidos.id_pais_1 = paises_1.id
      LEFT JOIN paises as paises_2
      ON partidos.id_pais_2 = paises_2.id
      LEFT JOIN apuestas
      ON partidos.id = apuestas.id_partido and apuestas.id_persona= ?
      WHERE partidos.id = ?";

    return obtenerArraySQL($conexion, $sql, [$id, $idPartido])[0];
  }

  public static function obternerApuestaspartido() {
    global $db;
    $idPartido = $_POST["idPartido"];

    $json = [];

    $sql = "SELECT 
      personas.id,
      personas.nombre,	
      apuesta_1,
      apuesta_2,
      apuestas.puntuacion
      FROM apuestas
      LEFT JOIN personas as personas
      ON apuestas.id_persona = personas.id
      WHERE apuestas.id_partido = ?";

    $json["porrasPartido"] = obtenerArraySQL($conexion, $sql, [$idPartido]);
    $json["id"] = $_SESSION["id"];

    return $json;
  }

  public static function apostar() {
    global $db;

    $id = $_SESSION["id"];
    $idPartido = $_POST["idPartido"];
    $idApuesta = $_POST["idApuesta"];
    $apuesta1 = $_POST["apuesta1"];
    $apuesta2 = $_POST["apuesta2"];

    if(isset($_POST["ganador"])){
      $ganador = $_POST["ganador"];
      if($idApuesta == null){
        $sql = "INSERT INTO apuestas (id_partido, id_persona, apuesta_1, apuesta_2, ganador) VALUES (:id_partido, :id_persona, :apuesta_1, :apuesta_2, :ganador)";	
      }else{
        $sql = "UPDATE apuestas set apuesta_1 = :apuesta_1, apuesta_2 = $apuesta2, ganador = $ganador where id = $idApuesta";
      }
    }else{
      if($idApuesta == null){
        $sql = "INSERT INTO apuestas (id_partido, id_persona, apuesta_1, apuesta_2) VALUES ($idPartido, $id, :apuesta_1, :apuesta_2)";	
      }else{
        $sql = "UPDATE apuestas set apuesta_1 = :apuesta_1, apuesta_2 = $apuesta2, ganador = null where id = $idApuesta";
      }
    }

    $json = [];
    try{
      obtenerArraySQL($db, $sql, [
        ':id_partido' => $id_partido,
        ':id_persona' => $id_persona,
        ':id_puesta' => $idApuesta,
        ':apuesta_1' => $apuesta1,
        ':apuesta_2' => $apuesta2,
        ':ganador' => $ganador 
      ]);
      
      $json["error"] = false;
    }catch(PDOException $e){
      $json["error"] = true;
      $json["e"] = $e;
    }

    return $json;
  }
}
?>