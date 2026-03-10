<?php
session_start();
$idPartido = $_POST["idPartido"];

include_once "../db/db.php";

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
	WHERE apuestas.id_partido = $idPartido";

$json["porrasPartido"] = obtenerArraySQL($conexion, $sql);
$json["id"] = $_SESSION["id"];

echo json_encode($json);
?>