<?php include "components/menu.php" ?>

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