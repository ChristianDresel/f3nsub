<?php
include("config.php");
include("function.php");

$time = time();
$query = $dbh->query("SELECT * FROM ip WHERE assign = '1'");
$result = $query->fetchAll(PDO::FETCH_OBJ);

foreach ($result as $row) {
	if (getrout($row->ip)) {
		$dbh->query("UPDATE ip SET last_announce = '$time', act_announce = '1' WHERE id = '$row->id'");
	}
	else {
		$dbh->query("UPDATE ip SET act_announce = '0' WHERE id = '$row->id'");
	}
}
