<?php
	session_start();

	$table_name = $_SESSION['table'];
	$PName = $_POST["Prod_Name"];
	$PQty = $_POST['Qty'];
	$SRP = $_POST['Price'];
	$Edate = date('Y-m-d');
	$Status = $_POST['Status'];


	try {
		$icommand = "INSERT INTO $table_name( Prod_Name, Qty, Price, Expiration_Date, Status) 
						   VALUES ('".$PName."', '".$PQty."',  '".$SRP."', '".$Edate."', '".$Status."')";

		include('connection.php');

		$con->exec($icommand);
		$res = [
			'success' => true,
			'message' => $Prod_Name.  ' Added Succesfully!'];
	}
		catch(PDOException $e) {
			$res = [
			'success' => false,
			'message' => $e->getMessage()
		]; 
		}
		
	$_SESSION['res'] = $res;
	header('location: ../add_prod.php');


?>