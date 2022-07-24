<?php

	$data = $_POST;
	$UserId = (int) $data['userid'];
	$First_Name = $data['ffname'];
	$Last_Name = $data['llname'];
	$Email =  $data['EmailAd'];

	try {
	
		
		$sql = "UPDATE users SET First_Name=?, Last_Name=?, Email=?, Updated_at=? WHERE ID=?";
		
		include('connection.php'); 

		$con->prepare($sql)->execute([$First_Name, $Last_Name, $Email, date('Y-m-d h-i-s'), $UserId]);

			echo json_encode([
			'success' => true,
			'message' => $First_Name . ' ' . $Last_Name . ' Updated Succesfully!'
		]);			
	}
		catch(PDOException $e) {

			echo json_encode([
			'success' => false,
			'message' => 'Action taken was cancelled!'
		]); 
	}

?>



