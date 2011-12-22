<?php

$mysql_db = "protomin";
$mysql_host = "localhost";
$mysql_user = "root";
$mysql_pass = "";
$baseUrl = "http://localhost:8988/protomin/";
$error404 = "http://www.protospace.ca/";

function http_redirect($url) {
    header("Location: $url");
    exit();
}

?>