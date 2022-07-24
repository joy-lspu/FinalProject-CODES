<?php

	$data = $_POST;
	$ProdId = (int) $data['ProdID'];
	$Prod_Name = $data['PName'];


	try {
		$command = "DELETE FROM product WHERE Prod_ID = {$ProdId}";

		include('connection.php');

		$con->exec($command);

			echo json_encode([
			'success' => true,
			'message' => $Prod_Name . ' Deleted Succesfully!'
		]);			
	}
		catch(PDOException $e) {

			echo json_encode([
			'success' => false,
			'message' => 'Delete action was cancelled!'
		]); 
	}

?>