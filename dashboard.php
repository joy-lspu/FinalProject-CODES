<?php
	
	session_start();
	if (!isset($_SESSION['user'])) header('location: login.php');
	$user = $_SESSION['user'];

	$_SESSION['table'] = 'product';
	$product = include('database/show_prod.php');

	$_SESSION['table'] = 'users';
	$users = include('database/show_user.php');

?>

<!DOCTYPE html>
<html>
<head>
	
	<title>GE DASHBOARD - Store Inventory System</title>

	<link rel="stylesheet" type="text/css" href="css/login.css">
	<script src="https://kit.fontawesome.com/b57cdd5fc9.js"></script>
</head>
<body>
	<div id="DBMain">
		<?php include('partial/menubar.php') ?>
			<div class="DB_content" id="DB_content">
		<?php include('partial/menubar-tn.php') ?>
			<div class="DB_Content">
				<div class="DBC_main">
					<div class="row">
						<div class ="col3">
							<i class="fa fa-user" style="font-size: 45px"></i>	
							<h1>Total Users</h1>
							<h1><?=count($users)?></h1> 	
						</div>
						<div class ="col3">
							<i class="fa fa-shopping-basket" style="font-size: 45px"></i>	
							<h1>Total Products</h1>
							<h1><?=count($product)?></h1> 	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
7
	<script src="jscript/sc.js"></script>
</body>
</html>