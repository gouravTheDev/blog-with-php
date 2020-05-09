<?php 
include 'config.php';
// USER-LOGIN

if (isset($_POST['loginSubmit'])) {
  $email = $_POST['email'];

  $password = $_POST['password'];

  $password = md5($password);

  // checking for user existance

  $sql = "SELECT * FROM USERS WHERE `EMAIL` = '$email'";
  $result = mysqli_query($link, $sql);

  $results = mysqli_num_rows($result); 
  if ($results == 0) {
  	echo '<div style="text-align:center;">
			The email is not registered!
			<br>
			<a href="/login.php">Go Back</a>
		  </div>';
  }else{
  	//fetch user row
  	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$passwordDB = $row['PASSWORD'];
  	// check the password
  	if ($passwordDB != $password) {
  		echo '<div style="text-align:center;">
				The password is wrong!
				<br>
				<a href="/login.php">Go Back</a>
			</div>';
  	}else{
  		session_start();
  		$_SESSION['loggedIn'] = true;
  		$_SESSION['userId'] = $row['ID'];
  		$_SESSION['userName'] = $row['NAME'];
  		$_SESSION['userEmail'] = $row['EMAIL'];
  		echo '<script>window.location.href="/dashboard.php"</script>';
  	}
  }

}

?>