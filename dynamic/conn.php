<?php 
function getConn(){
	$url = 'localhost';
	$u = 'root';
	$p = '12345678';
	$db = 'rexdb';
	
	return new MySQLi($url, $u, $p, $db);
}
?>