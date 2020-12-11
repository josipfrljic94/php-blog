<?php

$host='remotemysql.com';
$db='07BXuH33Ge';
$user="07BXuH33Ge";
$charset='utf8mb4';
$pass= "sdH5Ns7Bme";

$dsn="mysql:host=$host;dbname=$db;charset=$charset";
$dbh = new PDO($dsn, $user, $pass);
?>