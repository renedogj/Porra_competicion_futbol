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

      $_SESSION["id"] = $user["id"];
      $_SESSION["nombre"] = $user["nombre"];
      $_SESSION["puntuacion"] = $user["puntuacion"];
      $_SESSION["email"] = $user["email"];
      $_SESSION["token"] = $user["user_token"];

      return $user;
    }

    return null;
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