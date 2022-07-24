<?php

	$data = $_POST;
	$UserId = (int) $data['UserID'];
	$First_Name = $data['FName'];
	$Last_Name = $data['LName'];


	try {
		$command = "DELETE FROM users WHERE ID = {$UserId}";

		include('connection.php');

		$con->exec($command);

			echo json_encode([
			'success' => true,
			'message' => $First_Name . ' ' . $Last_Name . ' Deleted Succesfully!'
		]);			
	}
		catch(PDOException $e) {

			echo json_encode([
			'success' => false,
			'message' => 'Delete action was cancelled!'
		]); 
	}

?>