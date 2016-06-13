<!DOCTYPE html>
<html>
    <?php
		include 'AdminUser.php'; 
		include 'WPEateryDAO.php';

		session_start();
		mysqli_report(MYSQLI_REPORT_STRICT);
	
		$admin = null;
		if(isset($_SESSION["adminSession"])){
			$admin = $_SESSION["adminSession"];
				include("login_header.php");			// To show logout menu when user login as admin
			if(!$admin->isAuthenticated()) {
			}
		}
		else {
			include("header.php");		// Remove logout menu when user already loged out.
		}
	?>
			<div id="content" class="clearfix">
                <h1>Coming Soon!</h1>
            </div><!-- End Content -->
	<?php
		include("footer.php");
	?>
</html>
