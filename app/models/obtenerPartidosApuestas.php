<?php
session_start();
$id = $_SESSION["id"];

include_once "../db/db.php";

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
	ON partidos.id = apuestas.id_partido and apuestas.id_persona=$id
	ORDER BY fecha";

$partidos = obtenerArraySQL($conexion, $sql);

echo json_encode($partidos);
?>