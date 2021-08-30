<?php
$mysql_user = "root";
$mysql_pass = "Jitech40854085";
global $db;
try {
	$db = new PDO('mysql:host=20.20.20.2;dbname=raisepon;charset=utf8', $mysql_user, $mysql_pass);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo 'Connection Failed: ' . $e->getMessage();
	exit;
}
?>
