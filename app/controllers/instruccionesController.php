<?php
class instruccionesController {
  public function index() {
    $styles = [
      "assets/css/registrarse.css",
      "assets/css/partidos.css",
      "assets/css/instrucciones.css"
    ];
    
    ob_start();
    require "../app/views/instruccionesPage.php";
    $content = ob_get_clean();

    require "../app/views/layouts/main.php";
  }
}
?>