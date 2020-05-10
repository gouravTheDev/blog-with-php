<?php 
session_start();
 if(isset($_SESSION['loggedIn'])){
 	// $_SESSION['logout'];
    session_destroy();
    echo "<script>
		 	window.location.href='/';
		 	</script>";
    
}

 ?>