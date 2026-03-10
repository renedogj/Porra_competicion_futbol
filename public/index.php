<?php

$url = $_GET['url'] ?? '/';

require "../routes/routes.php";

Router::dispatch($url);

?>