<?php
class HomeController {
  public function index() {
    $styles = [
      "assets/css/home.css"
    ];

    $scripts = [
      "assets/js/login.js"
    ];

    ob_start();
    require "../app/views/homePage.php";
    $content = ob_get_clean();

    require "../app/views/layouts/main.php";
  }
}
?>