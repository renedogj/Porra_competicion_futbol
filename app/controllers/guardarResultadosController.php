<?php
class GuardarResultadosController {
  public function index() {
    AuthService::checkSessionRedirect(["idPartido"]);

	  $idPartido = $_GET["idPartido"];

    $styles = [
      "assets/css/apuesta.css",
    ];

    $scripts = [
      "assets/js/guardarResultados.js"
    ];

    ob_start();
    require "../app/views/guardarResultadosPage.php";
    $content = ob_get_clean();

    require "../app/views/layouts/main.php";
  }
}
?>