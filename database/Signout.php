<?php

	session_start();
	
	session_unset();

	session_destroy();

	$_SESSION['user'] = $user;
	
	header('location: ../login.php');


?>