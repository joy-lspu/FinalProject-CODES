<?php
	session_start();

	$table_name = $_SESSION['table'];
	$First_Name = $_POST["First_Name"];
	$Last_Name = $_POST['Last_Name'];
	$Email = $_POST['Email'];
	$Password = $_POST['Password'];

	try {
		$insert_command = "INSERT INTO $table_name( First_Name, Last_Name, Email, Password, Created_at, Updated_at) 
						   VALUES ('".$First_Name."', '".$Last_Name."', '".$Email."', '".$Password."', NOW(), NOW())";

		include('connection.php');

		$con->exec($insert_command);
		$res = [
			'success' => true,
			'message' => $First_Name . ' ' . $Last_Name . ' Added Succesfully!'];
	}
		catch(PDOException $e) {
			$res = [
			'success' => false,
			'message' => $e->getMessage()
		]; 
		}

		
	$_SESSION['res'] = $res;
	header('location: ../add_new.php');


?>