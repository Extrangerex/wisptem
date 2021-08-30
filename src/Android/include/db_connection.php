<?php
	/**
	*Database config variables
	*/
	define("DB_HOST","20.20.20.2");
	define("DB_USER","root");
	define("DB_PASSWORD","Jitech40854085");
	define("DB_DATABASE","jitechdata");

	$con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

	if(mysqli_connect_errno()){
		die("Database connnection failed " . "(" .
			mysqli_connect_error() . " - " . mysqli_connect_errno() . ")"
				);
	}
?>