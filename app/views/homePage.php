<div class="div-inicio">
	<div class="div-barraSuperior">
	  <?php include "components/menu.php" ?>
	</div>
	<div class="div-inicio-titulo">
	  <img src="img/logo-euro-2024.png">
		<h1 class="h1-inicio-titulo">Eurocopa 2024</h1>
    <br>
		<p>Proyecto desarrollado por los hermanos Renedo González</p>
	</div>
  <div class="div-inicioSesion">	
  	<?php
  	if(!isset($_SESSION["id"])){
      include "layouts/fromInicioSesion.html";
  	}else{
      include "layouts/sesionIniciada.php";
  	}
  	?>
	</div>
</div>