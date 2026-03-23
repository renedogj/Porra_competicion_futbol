<?php
require_once "../app/models/Partidos.php";

class apuestaController {
  public function index() {
    if(isset($_GET["idPartido"])){
	    $idPartido = $_GET["idPartido"];
    } else {
      header("Location: /");
      die();
    }

    $styles = [
      "assets/css/apuesta.css",
      "assets/css/tablas.css",
    ];

    $scripts = [
      "assets/js/apuesta.js"
    ];

    ob_start();
    require "../app/views/apuestaPage.php";
    $content = ob_get_clean();

    require "../app/views/layouts/main.php";
  }

  public function obtenerPartido() {  
    $partido = Partidos::obtenerPartido();
    echo json_encode($partido);
  }

  public function obternerApuestaspartido() {  
    $apuestas = Partidos::obternerApuestaspartido();
    echo json_encode($apuestas);
  }

  public function apostar() {  
    $apuesta = Partidos::apostar();
    echo json_encode($apuesta);
  }
}
?>