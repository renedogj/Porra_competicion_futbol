<?php

class User {
  public static function findByEmail($email) {

    global $db;

    $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public static function create($email, $password) {

    global $db;
    // $hash = password_hash($password, PASSWORD_DEFAULT);
    $hash = md5(trim($password));

    $stmt = $db->prepare(
      "INSERT INTO users (email, password) VALUES (?, ?)"
    );

    $stmt->execute([$email, $hash]);
  }

  public static function login($email, $password) {
    global $db;

    $json = [];
    $json["userVerified"] = false;

    $trimmedEmail = trim($email);
    $hashedPassword = md5(trim($password));

    $stmt = $db->prepare(
      "SELECT id, nombre, email, puntuacion, user_token FROM personas WHERE email = ? AND password = ?"
    );
    $stmt->execute([$trimmedEmail, $hashedPassword]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
      $updateStmt = $db->prepare("UPDATE personas SET fecha_inicio_sesion = CURRENT_TIMESTAMP WHERE id = ?");
      $updateStmt->execute([$user['id']]);
      
      session_start();
      $_SESSION["id"] = $user["id"];
      $_SESSION["nombre"] = $user["nombre"];
      $_SESSION["puntuacion"] = $user["puntuacion"];
      $_SESSION["email"] = $user["email"];
      $_SESSION["token"] = $user["user_token"];

      $json["userVerified"] = true;
    }

    return $json;

    // session_start();
    // $email = trim(addslashes($_POST["email"]));
    // $password = MD5(trim($_POST["password"]));

    // include_once "../db/db.php";

    // $sql = "SELECT id, nombre, email, puntuacion, user_token FROM personas WHERE email='$email' and password='$password'";

    // $usuario = obtenerArraySQL($conexion, $sql);

    // $json = [];
    // if(count($usuario) != 0){
    //   $json["error"] = false;
    //   $usuario = $usuario[0];

    //   $idUsuario = $usuario["id"];

    //   $sql = "UPDATE personas SET fecha_inicio_sesion = CURRENT_TIMESTAMP WHERE id='$idUsuario'";
    //   $conexion->exec($sql);
      
    //   $_SESSION["id"] = $usuario["id"];
    //   $_SESSION["nombre"] = $usuario["nombre"];
    //   $_SESSION["puntuacion"] = $usuario["puntuacion"];
    //   $_SESSION["email"] = $email;
    //   $_SESSION["token"] = $usuario["user_token"];
    // }else{
    //   $json["error"] = true;
    // }
    // echo json_encode($json);
  }

  
  public static function obtenerClasificaciones() {
    global $db;

    $json = [];

    $sql = "SELECT
        id, 
        nombre,
        puntuacion
        FROM personas
        ORDER BY puntuacion DESC, id ASC";

    $stmt = $db->prepare($sql);
    $stmt->execute();

    $json["clasificacion"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $json["id"] = isset($_SESSION["id"]) ? $_SESSION["id"] : null;
    
    return $json;
  }
}

?>