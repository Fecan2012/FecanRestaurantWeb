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
	
	
	<?php
		$connect = mysqli_connect("127.0.0.1", "root", "1234", "wp_eatery") or die('Error: ' . mysqli_error($connect));
		
		
		$customerNameErr = "";
		$phoneNumberErr = "";
		$emailAddressErr = "";
		$referralErr = "";
		
		$customerNamePass = true;
		$phoneNumberPass = true;
		$emailAddressPass = true;
		$referralPass = true;
		
		// To File upload to directory named 'file' 
		if(isset($_POST["uploadFile"])){
			$path = 'files/';
			$upload_file = $path.basename($_FILES['fileUpload']['name']);

			if(move_uploaded_file($_FILES['fileUpload']['tmp_name'],$upload_file)){
				echo "<script>alert('File uploaded successfully!');</script>";  // To show alert message when file uploaded successfully
			} else {
				echo "<script>alert('Failed!');</script>";   // To show alert message when file upload failed.
			}
		}

			
		function validateInput($data){
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		}
		
		function existName () {
			global $customerName;
			global $connect;
			$query = "SELECT customerName FROM mailinglist where customerName='$customerName'" or die(mysqli_error($connect));
					$log = $connect -> query($query);
					if ($log -> num_rows > 0){
						return true;
					}
					return false;
		}
		
		function existPhone () {
			global $phoneNumber;
			global $connect;
			$query = "SELECT phoneNumber FROM mailinglist where phoneNumber='$phoneNumber'" or die(mysqli_error($connect));
					$log = $connect -> query($query);
					if ($log -> num_rows > 0){
						return true;
					}
					return false;
		}
		
		function existEmail(){
			global $emailAddress;
			global $connect;
			$query = "SELECT emailAddress FROM mailinglist where emailAddress='$emailAddress'" or die(mysqli_error($connect));
					$log = $connect -> query($query);
					if ($log -> num_rows > 0){
						return true;
					}
					return false;
		}
		
		extract($_POST);
		
		if(isset($_POST["btnSubmit"])){
			
			$customerName = validateInput($customerName);
			$phoneNumber = validateInput($phoneNumber);
			$emailAddress = validateInput($emailAddress);

		
			if(empty($customerName)){
				$customerNameErr = "* Name is required!";
				$customerNamePass = false;
			}
			else {
				if (existName()){
					$customerNameErr = "* Name is already exists!";
					$customerNamePass = false;
				}
			}
											
			if(empty($phoneNumber)){
				$phoneNumberErr = "* Phone Number is required!";
				$phoneNumberPass = false;
			}
			else {
				if(!preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/i", $phoneNumber)){
					$phoneNumberErr = "* Please enter a valid Phone Number (000-000-0000)!";
					$phoneNumberPass = false;
				}
				else {
					if (existPhone()){
						$phoneNumberErr = "* Phone Number is already exists!";
						$phoneNumberPass = false;
					}
				}
			}
						
			if(empty($emailAddress)){
				$emailAddressErr = "* Email Address is required!";
				$emailAddressPass = false;
			}
			else {
				if(!preg_match("/^([\w\-]+\@[\w\-]+\.[\w\-]+)/",$emailAddress)){
					$emailAddressErr = "* Please enter an Email Address (johnsmith@wpeatery.com)!";
					$emailAddressPass = false;
				}
				else{
					if (existEmail()){
						$emailAddressErr = "* Email Address is already exists!";
						$emailAddressPass = false;
					}
				}
			}
			
			if(empty($referral)){
				$referralErr = "* Please choose one of the above options!";
				$referralPass = false;
			}
			
			if(($customerNamePass == true) && ($phoneNumberPass ==  true) && ($emailAddressPass == true) && ($referralPass == true)) {
				$emailHash = password_hash($emailAddress, PASSWORD_DEFAULT); // To ensure e-mail stored in database is encrypted.
				// Change INSERT statement to put email hash code into database instead of e-mail address.
				$sql="INSERT INTO mailinglist (customerName, phoneNumber, emailAddress, referrer)  VALUES('$customerName','$phoneNumber','$emailHash','$referral')";
				if (!mysqli_query($connect, $sql)){
					die('Error: ' . mysqli_error($con));
				}	
				else {
					header("Location: newsletterSignup.php");
				}							
			}		
			
		}
	
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
                    <h1>Sign up for our newsletter</h1>
                    <p>Please fill out the following form to be kept up to date with news, specials, and promotions from the WP eatery!</p>
                    <form name="frmNewsletter" id="frmNewsletter" method="post" action="contact.php" enctype="multipart/form-data">
                        <table>
                            <tr>
                                <td>Name:</td>
                                <td><input type="text" name="customerName" id="customerName" size='40' value=<?php if(isset($btnSubmit)) echo $customerName ?>></td>
                            </tr>
							<tr>
								<td></td>
								<td><span class="error"><?php if(isset($_POST["btnSubmit"])) echo $customerNameErr;?></span></td>								
                            </tr>
                                <td>Phone Number:</td>
                                <td><input type="text" name="phoneNumber" id="phoneNumber" size='40' value=<?php if(isset($btnSubmit)) echo $phoneNumber ?>></td>
                            </tr>
							<tr>
								<td></td>
								<td><span class="error"><?php if(isset($_POST["btnSubmit"])) echo $phoneNumberErr;?></span></td>								
                            </tr>
							<tr>
                                <td>Email Address:</td>
                                <td><input type="text" name="emailAddress" id="emailAddress" size='40' value=<?php if(isset($btnSubmit)) echo $emailAddress ?>></td>
                            </tr>
							<tr>
								<td></td>
								<td><span class="error"><?php if(isset($_POST["btnSubmit"])) echo $emailAddressErr;?></span></td>								
                            </tr>
                            <tr>
                                <td>How did you hear<br> about us?</td>
                                <td>Newspaper<input type="radio" name="referral" id="referralNewspaper" value="newspaper" <?php if (isset($btnSubmit) && isset($referral) && $referral == "newspaper") echo "checked" ?>>
                                    Radio<input type="radio" name='referral' id='referralRadio' value="radio" <?php if (isset($btnSubmit) && isset($referral) && $referral == "radio") echo "checked" ?>>
                                    TV<input type='radio' name='referral' id='referralTV' value="TV" <?php if (isset($btnSubmit) && isset($referral) && $referral == "TV") echo "checked" ?>>
                                    Other<input type='radio' name='referral' id='referralOther' value="other" <?php if (isset($btnSubmit) && isset($referral) && $referral == "other") echo "checked" ?>>
                            </tr>
							<tr>
								<td></td>
								<td><span class="error"><?php if(isset($_POST["btnSubmit"])) echo $referralErr;?></span></td>								
                            </tr>
								<tr><!--File Upload form-->
									<td>File Upload:</td>
									<td><input type="file" name="fileUpload" id="fileUpload" value="Open File">&nbsp;&nbsp;<input type='submit' name="uploadFile" id="uploadFile" value="Upload"></td>
								</tr>
                            <tr>
                                <td colspan='2'><input type='submit' name='btnSubmit' id='btnSubmit' value='Sign up!'>&nbsp;&nbsp;<input type='submit' name="btnReset" id="btnReset" value="Reset Form"></td>
                            </tr>
                        </table>
                    </form>
                </div><!-- End Main -->
            </div><!-- End Content -->
				
	<?php
		include("footer.php");
	?>
</html>