<?php
session_start();
if(!isset($_SESSION["id"]) || !isset($_GET["idPartido"])){
	session_unset();
	session_destroy();
	header("Location: ../");
	die();
}else{
	if($_SESSION["id"] != 1 || $_SESSION["id"] != 2){
		//header("Location: partidos.php");
		//die();
	}
	$idPartido = $_GET["idPartido"];
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
	<link rel="stylesheet" type="text/css" href="../css/apuesta.css">
</head>
<body>
	<script type="text/javascript">
		var idPartido = <?php echo '"'.$idPartido.'"'; ?>;
	</script>
	<nav class="nav-menu" id="menu"></nav>
	<?php
	include "../views/guardarResultado.html";
	?>
	<script type="text/javascript" src="../views/menu.js"></script>
	<script type="text/javascript" src="guardarResultado.js"></script>
</body>
</html>