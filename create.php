<?php

include 'config.php';

//expecting ?url=someurl

parse_str($_SERVER["QUERY_STRING"]);

$con = mysql_connect($mysql_host, $mysql_user, $mysql_pass);

if(!$con) http_redirect($url);

$db = mysql_select_db($mysql_db, $con);

if(!$db) {
    mysql_close($con);
    exit;
}

$result = mysql_query(sprintf("INSERT INTO urls (url) VALUES ('%s')", mysql_real_escape_string($url)));

$urlId = dechex(mysql_insert_id());

mysql_close($con);

echo $baseUrl . $urlId;

?>

