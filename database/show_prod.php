<?php 
	include('connection.php');

	$stmt1 = $con->prepare("UPDATE product SET Prod_Name = CONCAT(UCASE(LEFT(Prod_Name,1)), LCASE(SUBSTRING(Prod_Name,2)))");
	$stmt1->execute();

	$stmt1 = $con->prepare("SELECT * FROM product ORDER BY Prod_Name DESC");
	$stmt1->execute();
	$stmt1->setFetchMode(PDO::FETCH_ASSOC);
	return $stmt1->fetchAll();

?>