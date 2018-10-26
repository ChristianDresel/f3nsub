<?php
session_start();
include("config.php");
include("function.php");

if(!isset($_POST["erg"]) && !isset($_POST["send"])) {
	echo "Bitte die Rechnung l&ouml;sen um eine IP zu assignen:<br/>";
	echo captcha();
	echo '<form action="index.php" method="post">
			  <input type="text" size="17" name="erg">
			  <input type="hidden" size="17" name="send" value="true">
			  <input type="submit" value="assign">
		  </form>';
}
elseif ($_SESSION["erg"] == $_POST['erg'] && $_POST['send'] == true) {
	$query = $dbh->query("SELECT ip FROM ip WHERE assign = '0' LIMIT 1");
	$ip = $query->fetch();
	$ip = $ip[0];
	if($ip) {
		$dbh->query("UPDATE ip SET assign='1' WHERE ip='$ip'");
		echo "Du hast folgendes IP Netz bekommen: $ip <br /> <br />";
	}
	else {
		echo "Sorry, keine Subnetze mehr verfügbar";
	}
	session_destroy();
}
else {
	die("Falsch gerechnet?");
}