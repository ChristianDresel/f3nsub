<?php
function getrout($ip)
{
	$file = "/tmp/babeldump";
	if (shell_exec('echo "dump" | nc ::1 33123 -q 0 | grep ' . $ip . '')) {
		return true;
	} else {
		return false;
	}
}

function zahlinwort($zahl)
{
	$Return = array('Null', 'Eins', 'Zwei', 'Drei', 'Vier', 'F&uuml;nf', 'Sechs', 'Sieben', 'Acht', 'Neun', 'Zehn');

	return $Return[$zahl];
}

function captcha()
{
	$zahl1 = rand(0, 9);
	$zahl2 = rand(0, 9);
	$zeichen = rand(1, 2);
	if ($zeichen == 1) {
		$zeichen1 = "+";
		$_SESSION["erg"] = $zahl1 + $zahl2;
	}
	if ($zeichen == 2) {
		$zeichen1 = "*";
		$_SESSION["erg"] = $zahl1 * $zahl2;
	}

	return zahlinwort($zahl1) . ' ' . $zeichen1 . ' ' . zahlinwort($zahl2) . ' ergibt:';
}