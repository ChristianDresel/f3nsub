<?php
include("config.php");
require __DIR__ . '/vendor/autoload.php';

if ($initaktiv == 1) {
	$networks = IPTools\Network::parse($_GET['subnet'])->moveTo($_GET['size']);
	$stmt = $dbh->prepare("INSERT INTO ip (ip) VALUES (:network)");
	$counter = 0;
	foreach ($networks as $network) {
		$stmt->bindParam(':network', $network);
		$stmt->execute();
		$counter++;
	}
	echo "Es wurden $counter Subnetze von " . array_shift($networks) . " bis " . array_pop($networks) . " in die Datenbank eingetragen";
} else {
	echo 'Bitte $initaktiv in config.php auf 1 setzen';
}

//2a0c:b642:1030::/44