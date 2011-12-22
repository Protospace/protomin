<?php

require 'config.php';

$url = $error404;

$urlHex = $_SERVER["QUERY_STRING"];

$urlHex = preg_replace('/[^0-9A-F]/i','',$urlHex);

$urlId = hexdec($urlHex);

$con = mysql_connect($mysql_host, $mysql_user, $mysql_pass);

if(!$con) http_redirect($url);

$db = mysql_select_db($mysql_db, $con);

if(!$db) {
    mysql_close($con);
    http_redirect($url);
}

$result = mysql_query("SELECT * FROM urls WHERE Id = " . $urlId);

if (!$result || mysql_num_rows($result) == 0) {
    mysql_close($con);
    http_redirect($url);
}

$row = mysql_fetch_assoc($result);

$url = $row['url'];

mysql_query(
    sprintf("INSERT INTO urlTracking (urlId, clientip, useragent, requesturi, querystring, referer, method, serverRequestTime,  time)"
                               ." VALUES (   %s,     '%s',      '%s',       '%s',        '%s',    '%s',   '%s',              '%s', NOW())"
           , mysql_real_escape_string($urlId)
           , mysql_real_escape_string($_SERVER['REMOTE_ADDR'])
           , mysql_real_escape_string($_SERVER['HTTP_USER_AGENT'])
           , mysql_real_escape_string($_SERVER['REQUEST_URI'])
           , mysql_real_escape_string($_SERVER['QUERY_STRING'])
           , mysql_real_escape_string($_SERVER['HTTP_REFERER'])
           , mysql_real_escape_string($_SERVER['REQUEST_METHOD'])
           , mysql_real_escape_string($_SERVER['REQUEST_TIME'])
    )
);

mysql_close($con);

http_redirect($url);

?>