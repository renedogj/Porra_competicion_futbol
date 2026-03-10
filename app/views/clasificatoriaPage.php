<?php include "components/menu.php" ?>

<h1>Porra clasificación Eurocopa 2024</h1>
<h3 class="contdown">La votación se cierra en: <span id="countdown-timer"></span></h3>
<div class="divContenedoraInputPuesto">
  <div class="divInput_1_2_puesto">
    <div class="divInputPuesto">
      <label for="puesto_1">Primer puesto</label>
      <select id="puesto_1" name="puesto_1" class="selectPaises">
        <option>--</option>
      </select>
    </div>
    <div class="divInputPuesto">
      <label for="puesto_2">Segundo puesto</label>
      <select id="puesto_2" name="puesto_2" class="selectPaises">
        <option>--</option>
      </select>
    </div>
  </div>
  <!-- <div class="divInput_3_4_puesto">
    <div class="divInputPuesto">
      <label for="puesto_3">Tercer puesto</label>
      <select id="puesto_3" name="puesto_3" class="selectPaises">
        <option>--</option>
      </select>
    </div>
    <div class="divInputPuesto">
      <label for="puesto_4">Cuarto puesto</label>
      <select id="puesto_4" name="puesto_4" class="selectPaises">
        <option>--</option>
      </select>
    </div>
  </div> -->
</div>
<button id="guardarPorraClasificacion" class="button">Guardar</button>

<div class="divClasificatoriaApuestas" id="divClasificatoriaApuestas"></div>