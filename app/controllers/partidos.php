<?php
session_start();
if(!isset($_SESSION["id"])){
	session_unset();
	session_destroy();
	header("Location: ../");
	die();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Eurocopa 2024</title>
	<meta name=author content="Javier Renedo">

	<link rel="icon" type="image/png" href="img/favicon-euro-2024.png">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

	<link rel="stylesheet" type="text/css" href="../css/body.css"/>
	<link rel="stylesheet" type="text/css" href="../css/menu.css">
	<link rel="stylesheet" type="text/css" href="../css/tablas.css">
	<link rel="stylesheet" type="text/css" href="../css/partidos.css">
</head>
<body>
	<nav class="nav-menu" id="menu"></nav>
	<h1>Partidos Eurocopa 2024</h1>
	<h3>¡La porra de cada partido se cierra al comienzo del mismo!</h3>
	<div class="select">
		<select name="selectDisplay" id="selectDisplay">
			<option value="grupo">Partidos por grupo</option>
			<option value="fecha">Partidos por fecha</option>
		</select>
	</div>
	<div id="divPartidosPorGrupos" class="divContenedorTabla"></div>
	<div id="divPartidosPorFecha" class="divContenedorTabla">
		<div id="divTablaPartidosPorFecha"></div>
	</div>
	
	<script type="text/javascript" src="../views/menu.js"></script>
	<script type="text/javascript" src="partidos.js"></script>
	<script type="text/javascript" src="../views/partidos.js"></script>
</body>
</html>