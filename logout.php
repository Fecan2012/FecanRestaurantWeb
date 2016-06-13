<?php 
	session_start();	
	unset($_SESSION['adminSession']); 	
	header("Location:index.php");
	exit;	
?>