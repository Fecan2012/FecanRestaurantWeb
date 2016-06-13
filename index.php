<!DOCTYPE html>
<html>
	<?php
		include("menuItem.php");
	?>
    <?php
		include 'AdminUser.php'; 
		include 'WPEateryDAO.php';

		session_start();
		mysqli_report(MYSQLI_REPORT_STRICT);
	
		$admin = null;
		if(isset($_SESSION["adminSession"])){
			$admin = $_SESSION["adminSession"];
				include("login_header.php");		// To show logout menu when user login as admin
			if(!$admin->isAuthenticated()) {	
			}
		}
		else {
			include("header.php");					// Remove logout menu when user already loged out.
		}
	?>
            <div id="content" class="clearfix">
                <aside>

                        <h2><?php echo date("l"); ?>'s Specials</h2>
						<hr>
						<?php
						$menuOne = new menuItem("The WP Burger", "Freshly made all-beef patty served up with homefries", "$14","images/burger_small.jpg");
						$menuTwo = new menuItem("WP Kebobs", "Tender cuts of beef and chicken, served with your choice of side", "$17","images/kebobs.jpg");
							if(date("l")=="Monday" || date("l")=="Wednesday" || date("l")=="Friday"){
								echo "<img src=\"".$menuOne->getPicture()."\" alt=\"".$menuOne->getDescription()."\"title=\"".$menuOne->getItemName()."\">";
								echo "<h3>".$menuOne->getItemName()."</h3>";
								echo "<p>".$menuOne->getDescription()." - ".$menuOne->getPrice()."</p>";
								echo "<hr>";
								echo "<img src=\"".$menuTwo->getPicture()."\" alt=\"".$menuTwo->getDescription()."\"title=\"".$menuTwo->getItemName()."\">";
								echo "<h3>".$menuTwo->getItemName()."</h3>";
								echo "<p>".$menuTwo->getDescription()." - ".$menuTwo->getPrice()."</p>";
							}
							
							else{
								echo "<img src=\"".$menuTwo->getPicture()."\" alt=\"".$menuTwo->getDescription()."\"title=\"".$menuTwo->getItemName()."\">";
								echo "<h3>".$menuTwo->getItemName()."</h3>";
								echo "<p>".$menuTwo->getDescription()." - ".$menuTwo->getPrice()."</p>";
								echo "<hr>";
								echo "<img src=\"".$menuOne->getPicture()."\" alt=\"".$menuOne->getDescription()."\"title=\"".$menuOne->getItemName()."\">";
								echo "<h3>".$menuOne->getItemName()."</h3>";
								echo "<p>".$menuOne->getDescription()." - ".$menuOne->getPrice()."</p>";
							}
						?>
						<hr>
                </aside>
                <div class="main">
                    <h1>Welcome</h1>
                    <img src="images/dining_room.jpg" alt="Dining Room" title="The WP Eatery Dining Room" class="content_pic">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                    <h2>Book your Christmas Party!</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                </div><!-- End Main -->
            </div><!-- End Content -->
	<?php
		include("footer.php");
	?>
</html>
