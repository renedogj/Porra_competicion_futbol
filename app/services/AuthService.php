<?php

class AuthService {

  public static function checkSession() {

    if(!isset($_SESSION["token"]) || !isset($_SESSION["id"])){
      session_unset();
	    session_destroy();
      return null;
    }

    $token = $_SESSION["token"];
    $id = $_SESSION["id"];

    global $db;

    $stmt = $db->prepare("
      SELECT nombre, puntuacion, email, email_verificado, pagado
      FROM personas
      WHERE id = ? AND user_token = ?
    ");

    $stmt->execute([$id, $token]);

    $persona = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$persona){
      session_destroy();
      return null;
    }

    $_SESSION["nombre"] = $persona["nombre"];
    $_SESSION["puntuacion"] = $persona["puntuacion"];
    $_SESSION["email"] = $persona["email"];

    return $persona;
  }
}
?>