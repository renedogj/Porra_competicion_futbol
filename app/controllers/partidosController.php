<?php
require_once "../app/models/Partidos.php";

class partidosController {
  public function index() {
    AuthService::checkSessionRedirect();

    $styles = [
      "assets/css/tablas.css",
      "assets/css/partidos.css",
      // "assets/css/clasificaciones.css"
    ];

    $scripts = [
      "assets/js/partidos.js"
    ];

    ob_start();
    require "../app/views/partidosPage.php";
    $content = ob_get_clean();

    require "../app/views/layouts/main.php";
  }

  public function obtenerPartidosApuestas() {  
    $partidos = Partidos::obtenerPartidosApuestas();
    echo json_encode($partidos);
  }
}
?>