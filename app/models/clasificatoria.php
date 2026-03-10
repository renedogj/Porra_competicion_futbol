<?php
session_start();
if(isset($_SESSION["token"]) && isset($_SESSION["id"])){
	$token = $_SESSION["token"];
	$id = $_SESSION["id"];

	include_once "../db/db.php";

	$sql = "SELECT id FROM personas WHERE user_token = '$token'";

	if(obtenerArraySQL($conexion, $sql)[0]["id"] == $id){
		$sql = "SELECT puesto_1, puesto_2, puesto_3, puesto_4 
		from apuestas_clasificacion where id_persona = $id";

		$array = obtenerArraySQL($conexion, $sql);

		echo json_encode($array);
	}else{
		header('HTTP/1.1 401 Unauthorized', true, 401);
	}
}else{
	header('HTTP/1.1 401 Unauthorized', true, 401);
}
?>