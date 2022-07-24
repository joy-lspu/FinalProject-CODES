<?php 
	include('connection.php');

	$stmt = $con->prepare("UPDATE users SET First_Name = CONCAT(UCASE(LEFT(First_Name,1)), LCASE(SUBSTRING(First_Name,2))),
							Last_Name = CONCAT(UCASE(LEFT(Last_Name,1)), LCASE(SUBSTRING(Last_Name,2)))");
	$stmt->execute();

	$stmt = $con->prepare("SELECT * FROM users ORDER BY Created_at DESC");
	$stmt->execute();
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	return $stmt->fetchAll();

?>