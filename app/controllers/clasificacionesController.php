<?php
require_once "../app/models/User.php";

class clasificacionesController {
  public function index() {
    $styles = [
      "assets/css/tablas.css",
      "assets/css/partidos.css",
      "assets/css/clasificaciones.css"
    ];

    $scripts = [
      "assets/js/clasificaciones.js"
    ];

    ob_start();
    require "../app/views/clasificacionesPage.php";
    $content = ob_get_clean();

    require "../app/views/layouts/main.php";
  }

  public function obtenerClasificaciones() {
    $clasificaciones = User::obtenerClasificaciones();
    echo json_encode($clasificaciones);
  }
}
?>