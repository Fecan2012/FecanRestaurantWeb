<!DOCTYPE html>
<html>
<?php
	include("header.php");
?>

<?php
    require_once('WPEateryDAO.php');
	require_once('AdminUser.php');
	
    session_start();
    if(isset($_SESSION['adminSession'])){
        if($_SESSION['adminSession']->isAuthenticated()){
            session_write_close();
            header('Location:mailing_list.php');
        }
    }
	// To connect database for updating date/time in adminusers table.
	$connect = mysqli_connect("127.0.0.1", "root", "1234", "wp_eatery") or die('Error: ' . mysqli_error($connect));
	
	extract($_POST);
	
	$loginError = "";
	$loginNameError = "";   // To display wrong user input of the username and  the password.
	$loginPassError = "";
	$loginNamePass = true;
	$loginWordPass = true;
	
    if(isset($_POST['submit'])){
        if($username == null){
			$loginNameError = "*Enter the username!";
			$loginNamePass = false;
		}
		if($password == null){
			$loginPassError = "*Enter the password!";
			$loginWordPass = false;
		}
		
		if(($loginNamePass == true)&&($loginWordPass == true)){
		    $adminUser = new AdminUser($username, $password);
            if($adminUser->isAuthenticated()){
                $_SESSION['adminSession'] = $adminUser;
				$dateTime = date("Y-m-d H:i:s");    // To get current date and time.
				// To update date and time when user login last to userstable.
				$query="UPDATE adminusers SET Lastlogin='$dateTime' WHERE Username='admin'" or die(mysqli_error($connect));
				$log = $connect -> query($query);
            }
			else{
				unset($_SESSION['adminSession']);
				$loginError = "*The username and/or the password are not valid!";
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
                <h1>Log-in</h1>
                <p>Please enter your Username and Password correctly!</p>
				<form name="login" id="login" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
					<table>
						<tr>
							<td>Username:</td>
							<td><input type="text" name="username" id="username" value=<?php if(isset($submit)) echo $username ?>></td>
						</tr>
						<tr>
							<td></td>
							<td><span class="error"><?php if(isset($_POST['submit'])) echo $loginNameError;?></span></td>								
                        </tr>
						<tr>
							<td>Password:</td>
							<td><input type="password" name="password" id="password" value=<?php if(isset($submit)) echo $password ?>></td>
						</tr>
						<tr>
							<td></td>
							<td><span class="error"><?php if(isset($_POST['submit'])) echo $loginPassError;?></span></td>								
                        </tr>
						<tr>
						<?php echo "<div style = \"color:red;\">" . $loginError . "</div>"; ?>
						</tr>
						<tr>
							<td><input type="submit" name="submit" id="submit" value="Login"></td>
							<td><input type="reset" name="reset" id="reset" value="Reset"></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
<?php
	include("footer.php");
?>
</html>