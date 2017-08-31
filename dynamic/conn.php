<?php
function getConn(){
	$url = 'qdm112527347.my3w.com';
	$u = 'qdm112527347';
	$p = 'activezz1983';
	$db = 'qdm112527347_db';

	$mysqli = new MySQLi($url, $u, $p, $db);
	$mysqli->query("SET NAMES utf8");
	return $mysqli;
}
?>