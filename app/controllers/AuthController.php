<?php
require_once "../app/models/User.php";

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

    $user = User::login($email, $password);

    echo json_encode($user);
  }

  public function logout(){
    session_unset();
    session_destroy();
    echo json_encode(["success" => true]);
  }
}
?>