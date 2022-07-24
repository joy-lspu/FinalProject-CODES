<?php

	$data = $_POST;
	$ProdId = (int) $data['prodid'];
	$Prod_Name = $data['ppname'];
	$Quantity = $data['qqty'];
	$Price =  $data['pprice'];
	$Status = $data['sstat'];

	try {
	
		
		$sql = "UPDATE product SET Prod_Name=?, Qty=?, Price=?, Status=? WHERE Prod_ID=?";
		
		include('connection.php'); 

		$con->prepare($sql)->execute([$Prod_Name, $Quantity, $Price, $Status, $ProdId]);

			echo json_encode([
			'success' => true,
			'message' => $Prod_Name . ' Updated Succesfully!'
		]);			
	}
		catch(PDOException $e) {

			echo json_encode([
			'success' => false,
			'message' => 'Action taken was cancelled!'
		]); 
	}

?>