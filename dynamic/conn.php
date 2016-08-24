<?php 
function getConn(){
	$url = 'localhost';
	$u = 'root';
	$p = '12345678';
	$db = 'rexdb-website';
	
	return new MySQLi($url, $u, $p, $db);
}
?>