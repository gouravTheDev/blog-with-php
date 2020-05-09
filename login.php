<?php
 include 'header.php';
?>
<div class="container mt-2">
	<div class="card shadow">
		<div class="card-body">
			<h1 class="text-center">Login your account</h1>
			<hr>
			<div class="col-lg-6 col-sm-12 mx-auto">
				<form action="backend/loginExec.php" method="POST">
					<div class="form-group">
						<label><b>Email</b></label>
						<input type="email" class="form-control" name="email" placeholder="Enter your email" required>
					</div>
					<div class="form-group">
						<label><b>Password</b></label>
						<input type="password" class="form-control" name="password" placeholder="Enter your password" required>
					</div>
					<div class="form-group text-center">
						<input type="submit" class="btn btn-lg btn-success mr-auto" name="loginSubmit" value="Login">
					</div>
				</form>
				<div class="text-center">
					<a href="signup.php">Create Account</a>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="js/script.js"></script>