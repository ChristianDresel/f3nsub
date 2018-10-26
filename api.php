<?php
include("config.php");
include("function.php");

$data = array();
$abgelaufen = time() - $abgelaufen_zeit;
if ($_GET['abfrage'] == "all") {
	$query = $dbh->query("SELECT * FROM ip WHERE assign = '1'");
}
if ($_GET['abfrage'] == "aktiv") {
	$query = $dbh->query("SELECT * FROM ip WHERE assign = '1' AND act_announce = '1'");
}
if ($_GET['abfrage'] == "inaktiv") {
	$query = $dbh->query("SELECT * FROM ip WHERE assign = '1' AND act_announce = '0'");
}
if ($_GET['abfrage'] == "abgelaufen") {
	$query = $dbh->query("SELECT * FROM ip WHERE assign = '1' AND act_announce = '0' AND last_announce < '$abgelaufen' AND last_announce > '1'");
}
if ($_GET['abfrage'] == "nieaktiv") {
	$query = $dbh->query("SELECT * FROM ip WHERE assign = '1' AND act_announce = '0' AND last_announce = '0'");
}
$result = $query->fetchAll(PDO::FETCH_OBJ);
foreach ($result as $row) {
	$datas = array();
	$datas['ip'] = $row->ip;
	$datas['act_announce'] = $row->act_announce;
	$datas['last_announce'] = $row->last_announce;
	array_push($data, $datas);
}
header("Content-Type: application/json");
echo json_encode($data, JSON_PRETTY_PRINT);
//print_r($data);