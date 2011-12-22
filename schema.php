<?php

require 'config.php';

$con = mysql_connect($mysql_host, $mysql_user, $mysql_pass);

if(!$con) exit;

$db = mysql_select_db($mysql_db, $con);

if(!$db) {
    if(!mysql_query("CREATE DATABASE " . $mysql_db, $con)) {
        mysql_close($con);
        exit;
    }
}

$db = mysql_select_db($mysql_db, $con);

if(!$db) {
    mysql_close($con);
    exit;
}

$result = mysql_query("CREATE TABLE IF NOT EXISTS `urls` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `url` TEXT NOT NULL ,
  `created` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) )");

if(!$result) {
    mysql_close($con);
    exit;
}

$result = mysql_query("CREATE  TABLE IF NOT EXISTS `urlTracking` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `urlId` INT NOT NULL ,
  `time` DATETIME NOT NULL ,
  `clientip` VARCHAR(45) NULL ,
  `method` VARCHAR(10) NULL ,
  `serverRequestTime` VARCHAR(45) NULL ,
  `useragent` TEXT NULL ,
  `referer` TEXT NULL ,
  `querystring` TEXT NULL ,
  `requesturi` TEXT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) )");

if(!$result) {
    mysql_close($con);
    exit;
}

mysql_close($con);

?>
finished.