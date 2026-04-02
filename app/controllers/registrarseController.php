<?php
class RegistrarseController {
  public function index() {
    $styles = [
      "assets/css/registrarse.css"
    ];

    $scripts = [
      "assets/js/registrarse.js"
    ];

    ob_start();
    require "../app/views/registrarsePage.html";
    $content = ob_get_clean();

    require "../app/views/layouts/main.php";
  }
}
?>