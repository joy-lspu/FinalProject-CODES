<?php
	$servername = "localhost:3307";
	$username = "root";
	$password = "root";

	try {
		$con = new PDO("mysql:host=$servername; dbname=ge_inventorysystem", $username,$password);
		} catch(PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
		$err_msg = $e->getMessage();
	}
?>