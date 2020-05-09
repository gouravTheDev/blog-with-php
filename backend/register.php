<?php 
include 'config.php';
$link = new mysqli(MYSQL_HOST,MYSQL_USER,MYSQL_PASS,MYSQL_DB);
if ($link->connect_error) $errorm="connection failed: " . $link->connect_error;
$link->set_charset("utf8");

// USER-LOGIN

if (isset($_POST['registerSubmit'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$password = $_POST['password'];
	$password2 = $_POST['password2'];

	// CHECK PASSWORDS ARE SAME OR NOT

	if ($password != $password2) {
		echo '<div class="alert alert-danger text-center">
				Passwords are not same! <br>
				<a href="register.php">Go Back</a>
			</div>';
	}else{
		//Check for existing user

		$sql = "SELECT * FROM USERS WHERE EMAIL='$email'";
		$result = mysqli_query($link, $sql);
		$noOfusers = mysqli_num_rows($result);
		if ($noOfusers>0) {
			echo '<div style="text-align:center;">
			The email is already registered!
			<br>
			<a href="register.php">Go Back</a>
			</div>';
		}else{
			// Hash Password befire storing in Database
			$securePassword = md5($password);

			// STORE DATA IN DB

			$stmt = $link->prepare("INSERT INTO USERS (`TYPE`, `NAME`, `EMAIL`, `PHONE`,`PASSWORD`)VALUES('GEN_USER', ?, ?, ?, ?)");

			$stmt->bind_param("ssss", $name, $email, $phone, $password);

			$result = $stmt->execute();
			if ($result) {
				session_start();
				$_SESSION['userName'] = "Hello";
				echo '<script>window.location.href="/dashboard.php"</script>';
			}else{
				echo '<div style="text-align:center;">
				Some error! Try again!
				<br>
				<a href="register.php">Go Back</a>
				</div>';
			}
		}
	}

	
}

?>
