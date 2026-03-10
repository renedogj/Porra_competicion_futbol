<?php
include_once "../db/db.php";

$sql = "SELECT id from personas";
$personas = obtenerArraySQL($conexion, $sql);

$sql = "SELECT id_persona, puntuacion from apuestas";
$apuestas = obtenerArraySQL($conexion, $sql);

$sql = "SELECT id_persona, puntuacion from apuestas_clasificacion";
$apuestaGanador = obtenerArraySQL($conexion, $sql);

foreach($personas as $persona){
	$id_persona = $persona["id"];
	$puntuacion = 0;
	foreach($apuestas as $apuesta){
		if($apuesta["id_persona"] == $id_persona){
			$puntuacion += $apuesta["puntuacion"];
		}
	}
	$key = array_search($id_persona, array_column($apuestaGanador, 'id_persona'));
	$puntuacion += $apuestaGanador[$key]["puntuacion"];

	$sql = "UPDATE personas set puntuacion = $puntuacion where id = $id_persona";
	$conexion->exec($sql);
}
?>