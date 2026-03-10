<?php
session_start();
$email = trim(addslashes($_POST["email"]));
$nombre = trim(addslashes($_POST["nombre"]));
$telefono = $_POST["telefono"];
$pwd = MD5(trim($_POST["password"]));

include_once "../db/db.php";

$informacion = json_decode(file_get_contents("../informacion.json"), true);
$idPoliticaPrivacidad = $informacion["politicaPrivacidad"];

$json = [];

$numRandom = rand();

switch(rand(1,6)){
	case 1:
	$token = hash('sha256', $pwd . $email . $numRandom*$telefono);
	break;
	case 2:
	$token = hash('sha256', $pwd . $numRandom*$telefono . $email);
	break;
	case 3:
	$token = hash('sha256', $numRandom*$telefono . $pwd . $email);
	break;
	case 4:
	$token = hash('sha256', $numRandom*$telefono . $email . $pwd);
	break;
	case 5:
	$token = hash('sha256', $email . $numRandom*$telefono . $pwd);
	break;
	case 6:
	$token = hash('sha256', $email . $pwd . $numRandom*$telefono);
	break;
}

try {
	$sql = "INSERT INTO personas (email, nombre, password, telefono, user_token) VALUES ('$email','$nombre','$pwd', '$telefono', '$token')";
	
	$conexion->exec($sql);
	
	$id = $conexion->lastInsertId();

	$json["error"] = false;
	
	$_SESSION["id"] = $id;
	$_SESSION["nombre"] = $nombre;
	$_SESSION["puntuacion"] = 0;
	$_SESSION["email"] = $email;
	$_SESSION["token"] = $token;

} catch(PDOException $e) {
	$json["error"] = true;
	$json["errorInfo"]["errorCode"] = $e->getCode();

	if($e->getCode() == 23000){
		$json["errorInfo"]["code"] = $e->errorInfo[1];
		if($e->errorInfo[1] == 1062){
			$key = str_replace("'","",explode(" ",$e->errorInfo[2])[5]);
			$json["errorInfo"]["key"] = $key;
		}
	}
}
echo json_encode($json);
?>