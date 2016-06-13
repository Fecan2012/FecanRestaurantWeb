<!DOCTYPE html>
<html>
	<?php
		include("login_header.php");
		adminSession();
	?>
		<div id="content" class="clearfix">
            <aside>
                    <h2>Mailing Address</h2>
                    <h3>338 W 44th Ave<br>
                        Vancouver, BC V5Y 2V6</h3> 
                    <h2>Phone Number</h2>
                    <h3>(778)682-3435</h3>
                    <h2>Fax Number</h2>
                    <h3>(778)682-3435</h3>
                    <h2>Email Address</h2>
                    <h3>fecan2012@gmail.com</h3>
            </aside>
			<div class="main"> 
	<?php
			$adminUser = $_SESSION["adminSession"];
			
			mysqli_report(MYSQLI_REPORT_STRICT);
			$connect = mysqli_connect("127.0.0.1", "wp_eatery", "password", "wp_eatery") or die('Error: ' . mysqli_error($link));
			$query = "SELECT * FROM mailinglist" ;
			$log = $connect->query($query) or die('Error: ' . mysqli_error($conect));
			echo "<table style=\"text-align:center;\">";
			echo "<tr><th style=\"width:100px;\">Customer</th><th style=\"width:150px;\">Phone</th><th style=\"width:250px;\">Email Address[Hash_Code]</th><th style=\"width:100px;\">Referral</th></tr>";
			while ($row = mysqli_fetch_array($log)) 
			{
			echo "<tr><td>".$row['customerName']."</td><td>".$row['phoneNumber']."</td><td style=\"word-break:break-all;\">".$row['emailAddress']."</td><td>".$row['referrer']."</td></tr>";	
			}
			echo "</table>";
			mysqli_close($connect);
	?>
			</div>
		</div>
	<?php
		include("footer.php");
	?>
</html>