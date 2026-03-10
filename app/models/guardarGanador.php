<?php
//Introducir el id de los ganadores en orden
$idPuestos = [];

include_once "../db/db.php";

$sql = "SELECT id_persona, puesto_1, puesto_2 from apuestas_clasificacion";

$apuestas = obtenerArraySQL($conexion, $sql);

foreach($apuestas as $apuesta){
	$puntuacion = 0;
	$arrPuestos = [$apuesta["puesto_1"], $apuesta["puesto_2"]];

	for($i=0; $i<2; $i++){
		if (in_array($idPuestos[$i], $arrPuestos)){
			$puntuacion++;
		}
		if($idPuestos[$i] == $arrPuestos[$i]){
			$puntuacion += 20-10*$i;
		}
	}

	$id_persona = $apuesta["id_persona"];
	
	$sql = "UPDATE apuestas_clasificacion SET puntuacion = $puntuacion where id_persona = $id_persona";
	$conexion->exec($sql);

	$sql = "UPDATE personas SET puntuacion = puntuacion + $puntuacion where id = $id_persona";
	$conexion->exec($sql);

	$puntuacion = 0;
}
?>