<?php
session_start();

include_once "../db/db.php";

$json = [];

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

$json["clasificatoria"] = obtenerArraySQL($conexion, $sql);
$json["id"] = $_SESSION["id"];

echo json_encode($json);
?>