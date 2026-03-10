<?php
session_start();
if(isset($_SESSION["token"]) && isset($_SESSION["id"])){
	$token = $_SESSION["token"];
	$id = $_SESSION["id"];
	include_once "db/db.php";

	$sql = "SELECT 
		nombre,
		puntuacion,
		email,
		email_verificado,
		pagado
		from personas where id= $id and user_token = '$token'";

	$persona = obtenerArraySQL($conexion, $sql)[0];

	$_SESSION["nombre"] = $persona["nombre"];
	$_SESSION["puntuacion"] = $persona["puntuacion"];
	$_SESSION["email"] = $persona["email"];
	$emailVerificado = $persona["email_verificado"];
	$pagado = $persona["pagado"];
}
?>
<!-- <!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Eurocopa 2024</title>
	<meta name=author content="Javier Renedo">

	<link rel="icon" type="image/png" href="img/favicon-euro-2024.png">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

	<link rel="stylesheet" type="text/css" href="css/body.css"/>
	<link rel="stylesheet" type="text/css" href="css/indexInicio.css">
	<link rel="stylesheet" type="text/css" href="css/menu.css">
</head>
<body>
	<div class="div-inicio">
		<div class="div-barraSuperior">
			<nav class="nav-menu" id="menu"></nav>
		</div>
		<div class="div-inicio-titulo">
			<img src="img/logo-euro-2024.png">
			<h1 class="h1-inicio-titulo">Eurocopa 2024</h1>
			<br>
			<p>Proyecto desarrollado por los hermanos Renedo González</p>
		</div>
		<div class="div-inicioSesion">	
			<!-- <?php
			if(!isset($_SESSION["id"])){
				include "views/fromInicioSesion.html";
			}else{
				include "views/sesionIniciada.php";
			}
			?> -->
		</div>
	</div>
	<script type="text/javascript" src="views/menu.js"></script>
	<script type="text/javascript" src="controllers/inicio.js"></script>
	<script type="text/javascript" src="controllers/validarFormularios.js"></script>
</body>
</html> -->