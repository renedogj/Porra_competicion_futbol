<?php
session_start();
include_once "../db/db.php";
$json = [];

$sql = "SELECT
	id, 
	nombre,
	puntuacion
	FROM personas
	ORDER BY puntuacion DESC,id ASC";

$json["clasificacion"] = obtenerArraySQL($conexion, $sql);
$json["id"] = $_SESSION["id"];
echo json_encode($json);
?>