<?php
require_once "../app/models/ApuestaGanador.php";
require_once "../app/models/Paises.php";

class clasificatoriaController {
  public function index() {
    $styles = [
      "assets/css/tablas.css",
      "assets/css/partidos.css",
      "assets/css/clasificatoria.css",
    ];

    $scripts = [
      "assets/js/clasificatoria.js"
    ];

    ob_start();
    require "../app/views/clasificatoriaPage.php";
    $content = ob_get_clean();

    require "../app/views/layouts/main.php";
  }
 
  public function obtenerApuestas() {
    $apuestas = ApuestaGanador::obtenerApuestas();
    echo json_encode($apuestas);
  }

  public function obtenerApuestaUsuario() {
    $apuestaUser = ApuestaGanador::obtenerApuestaUsuario();
    echo json_encode($apuestaUser);
  }

  public function apostar() {
    $apostar = ApuestaGanador::apostar();
    echo json_encode($apostar);
  }

  public function obtenerPaises() {
    $paises = Paises::obtenerPaises();
    echo json_encode($paises);
  }
}
?>