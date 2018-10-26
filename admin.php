<?php
include("config.php");
include("function.php");

echo "Die aktuellen Announcements sowie last_announce wird nur 1x täglich aktualisiert";
echo "<table><tr><td>ip</td><td>last_announce</td>";
$query = $dbh->query("SELECT * FROM ip WHERE assign = '1'");
$result = $query->fetchAll(PDO::FETCH_OBJ);

foreach($result as $row) {
	$datum = date("d.m.Y", $row->last_announce);
	$uhrzeit = date("H:i", $row->last_announce);
	$zeit = '' . $datum . ' - ' . $uhrzeit . ' Uhr';
	if ($row->act_announce == 1) {
		echo '<tr><td>' . $row->ip . '</td><td>' . $zeit . '</td><td>Wird aktuell announced</td></tr>';
	} else {
		echo '<tr><td>' . $row->ip . '</td><td>' . $zeit . '</td><td>Wird aktuell nicht announced</td></tr>';
	}
}