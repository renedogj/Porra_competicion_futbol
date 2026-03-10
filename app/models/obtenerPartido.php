<?php
session_start();
$id = $_SESSION["id"];
$idPartido = $_POST["idPartido"];
include_once "../db/db.php";

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
	ON partidos.id = apuestas.id_partido and apuestas.id_persona=$id
	WHERE partidos.id = $idPartido";

$partido = obtenerArraySQL($conexion, $sql)[0];

echo json_encode($partido);
?>