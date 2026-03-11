<?php
class AuthController {
  public function register() {
    $email = $_POST["email"];
    $password = $_POST["password"];

    if(User::findByEmail($email)){
      echo json_encode(["error" => "email_exists"]);
      return;
    }

    User::create($email, $password);

    echo json_encode(["success" => true]);
  }

  public function login() {

    $email = $_POST["email"];
    $password = $_POST["password"];

    $user = 9::findByEmail($email);

    if(!$user || !password_verify($password, $user["password"])){
      echo json_encode(["error" => true]);
      return;
    }

    $_SESSION["user_id"] = $user["id"];

    echo json_encode(["success" => true]);

  }

  public function logout(){
    session_destroy();
    echo json_encode(["success" => true]);
  }
}
?>