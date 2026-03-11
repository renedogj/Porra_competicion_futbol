<div class="sesionIniciada" id="sesionIniciada">
	<h1>Bienvenido <?php echo $_SESSION["nombre"]?></h1>
	<?php
	if ($_SESSION["pagado"] == 0){
		echo '<p>Para completar el registro y participar en la porra deberá hacer un <b>bizum de 2€ al 639679097</b> con el concepto:<br><b>"Euro24 nombre con el que te has registrado"</b></p>';
		echo '<p>Si ya ha realizado el bizum, tenga paciencia y mientras tanto ¡Vote!</p>';
	}elseif ($_SESSION["pagado"] > 0 && $_SESSION["pagado"] < 2){

	}else{
		echo '<h3>Tienes ' . $_SESSION["puntuacion"] . ' puntos</h3>';
		echo '<br><h3>Gracias por tu aportación al proyecto misionero de la <a href="https://www.parroquiasanleandro.es/proyecto-misionero-23-24">parroquia San Leandro</a></h3><p>Usted ha aportado: ' . $_SESSION["pagado"] . '</p>';
	}
	?>
	<button class="button" id="bttn-cerrarSesion">Cerrar Sesión</button>
</div>