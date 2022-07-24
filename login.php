<?php
	
	session_start();

	if (isset($_SESSION['user'])) header('location: dashboard.php');

	$err_msg = '';

	if($_POST) {
		include('database/connection.php');

		$username = $_POST['username'];
		$password = $_POST['password'];

		$query = 'SELECT * FROM users WHERE users.email="'. $username .'" AND users.password="'. $password .'"';
		$stmt = $con->prepare($query);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {	

		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$user= $stmt->fetchAll()[0];
		$_SESSION['user'] = $user;
		
		header('location: dashboard.php');

		} else $err_msg = 'Login Failed. Access denied.';


	}

	
?>


<!DOCTYPE html>
<html>
<head>
	
	<title>GE Inventory System</title>

	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body id="LBody">
	<?php if (!empty($err_msg)) { ?>
	<div id="ErrMsg">
		<strong>ERROR:</strong> <p> <?= $err_msg ?> </p>
	</div>	
	<?php } ?>
	
	<div class="container">
		<div class="LHeader">
		<img src="images/ge_logo.png" alt="Logo" />
		</div>
	<div class="is">INVENTORY SYSTEM</div>
	</div>
	<div class="LBody">
		<form method="POST" action="login.php">
			<div  class="LSignIn">
				<label for="UserName">EMAIL ADD</label>
				<input placeholder="Enter Email Add" name="username" type="text" required />
			</div>
			<div class="LSignIn">
				<label for="Password">Password</label>
				<input placeholder="Enter Password" name="password" type="password" required />
			</div>
			<div class="LButton">
				<button>Login</button>
			</div>
		</form>
		
	</div>
</body>
</html>