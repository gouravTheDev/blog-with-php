<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Discussion Forum</title>
	<link rel="stylesheet" type="text/css" href="css/project.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<!-- <script type="text/javascript" src="js/project.js"></script> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
	<div class="topnav" id="myTopnav">
		<div class="container">
			  <a href="/" class="btn btn-primary">Discussion Forum</a>
			  <a href="questions.php" class="btn btn-primary">Questions</a>
			  <?php 
			    if(isset($_SESSION['loggedIn'])){ ?>
			    	<a href="dashboard.php" class="btn btn-primary">Dashboard</a>
			    	<a href="logout.php" class="btn btn-primary lg-btn">Logout</a>
				<?php }else{ ?>
					 <a href="login.php" class="btn btn-primary lg-btn">Login</a>
				<?php } ?>
			 
			  
			  <a href="javascript:void(0);" class="icon btn btn-primary" onclick="myFunction()">
			  	<i class="fa fa-bars"></i>
			  </a>
		</div>
      
	</div>