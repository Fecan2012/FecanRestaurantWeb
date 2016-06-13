<!DOCTYPE html>
<?php
	// Header with logout menu.
	function adminSession() {
		include 'AdminUser.php'; 
		include 'WPEateryDAO.php';

		session_start();
		mysqli_report(MYSQLI_REPORT_STRICT);
	
		$admin = null;
		if(isset($_SESSION["adminSession"])){
			$admin = $_SESSION["adminSession"];

			if(!$admin->isAuthenticated()) {
				header("Location:userlogin.php");
				exit;	
			}
		}
		else {
			header("Location:userlogin.php");
			exit;
		}
	}
?>
	
<html>
    <head>
        <title>Fecan PHP - Home</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href='http://fonts.googleapis.com/css?family=Fugaz+One|Muli|Open+Sans:400,700,800' rel='stylesheet' type='text/css' />
        <link href="css/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="wrapper">
            <header class="clearfix">
                <img src="images/header_img.jpg" alt="Dining Room" title="WP Eatery"/>
                <div id="title">
                    <h1>Fecan PHP</h1>				
                    <h2>338 W 44th Ave</h2>					
					<h2>Vancouver BC V5Y 2V6</h2>  
					<h2><br>Tel: (778) 682-3435</h2>					
                </div>
            </header>
            <nav>
                <div id="menuItems">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="menu.php">Menu</a></li>
                        <li><a href="contact.php">Contact</a></li>
						<li><a href="mailing_list.php">List</a></li>
                    </ul>
                </div>
            </nav>