<?php

class AuthService {

  public static function checkSession() {

    if(!isset($_SESSION["token"]) || !isset($_SESSION["id"])){
      return logout();
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
      return logout();
    }

    $_SESSION["nombre"] = $persona["nombre"];
    $_SESSION["puntuacion"] = $persona["puntuacion"];
    $_SESSION["email"] = $persona["email"];
    $_SESSION["emailVerificado"] = $persona["email_verificado"];
    $_SESSION["pagado"] = $persona["pagado"];

    return $persona;
  }

  public static function checkSessionRedirect($params = []) {
    if(!isset($_SESSION["token"]) || !isset($_SESSION["id"])){
      logout();

      return redirectHome();
    }

    if($params != []){
      foreach ($params as $param){
        if(!isset($_GET[$param])){
          return redirectHome();
        }else if($_GET[$param] == "" || $_GET[$param] == null){
          return redirectHome();
        }
      }
    }
  }  
}

function logout(){
  session_unset();
  session_destroy();
  return null;
}

function redirectHome(){
  header("Location: ../public/");
  die();
  return null;
}
?>