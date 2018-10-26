<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$mysql_host = "localhost";
$mysql_user = "username";
$mysql_pass = "password";
$mysql_dbname = "database";

try {
	$dbh = new PDO("mysql:host=$mysql_host;dbname=$mysql_dbname", $mysql_user, $mysql_pass);
} catch (PDOException $e) {
	die("Error!: ". $e->getMessage()."<br/>");
}

$initaktiv = 0;
$abgelaufen_zeit = 365 * 24 * 60 * 60; //In Sekunden