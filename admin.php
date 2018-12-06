<!DOCTYPE html>
<html>
<head>
<title>F3 Netze Subnetzvergabe</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>

<?php
include("config.php");
include("function.php");

echo "Die aktuellen Announcements sowie last_announce wird nur 1x täglich aktualisiert";
echo '<table class="table"><thead class="thead-dark"><tr><td>ip</td><td>last_announce</td><td>Status</td></tr></thead>';
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
?>
</body></html>
