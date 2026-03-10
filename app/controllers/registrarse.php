<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Eurocopa 2024 - Registrarse</title>
	<meta name=author content="Javier Renedo">

	<link rel="icon" type="image/png" href="img/favicon-euro-2024.png">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

	<link rel="stylesheet" type="text/css" href="../css/body.css"/>
	<link rel="stylesheet" type="text/css" href="../css/menu.css">
	<link rel="stylesheet" type="text/css" href="../css/registrarse.css">
</head>
<body>
	<nav class="nav-menu" id="menu"></nav>
	<?php
	include "../views/formRegistrarse.html";
	?>
	<script type="text/javascript" src="../views/menu.js"></script>
	<script type="text/javascript" src="registrarse.js"></script>
	<script type="text/javascript" src="validarFormularios.js"></script>
</body>
</html>