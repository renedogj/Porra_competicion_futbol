<?php
include_once "../db/db.php";

$sql = "SELECT id, nombre, abreviatura, grupo from paises order by grupo";

$partidos = obtenerArraySQL($conexion, $sql);

echo json_encode($partidos);
?>