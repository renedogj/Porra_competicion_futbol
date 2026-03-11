<?php
session_start();

require "../db/db.php";
require "../routes/routes.php";
require "../app/services/AuthService.php";

AuthService::checkSession();

$url = $_GET['url'] ?? '/';

Router::dispatch($url);

?>