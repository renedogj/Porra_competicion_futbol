<?php
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
}
?>