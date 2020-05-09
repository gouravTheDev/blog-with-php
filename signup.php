<?php 
session_start();
echo $_SESSION['userName'];
?>
<div class="container mt-2">
	<div class="card shadow">
		<div class="card-body">
			<h1 class="text-center">Create a new account</h1>
			<hr>
			<div class="col-lg-6 col-sm-12 mx-auto">
				<form action="backend/register.php" method="POST">
					<div class="form-group">
						<label><b>Name</b></label>
						<input type="text" class="form-control" name="name" placeholder="Enter Your Full Name" required>
					</div>
					<div class="form-group">
						<label><b>Email</b></label>
						<input type="email" class="form-control" name="email" placeholder="Enter your email" required>
					</div>
					<div class="form-group">
						<label><b>Phone Number</b></label>
						<input type="text" class="form-control" name="phone" placeholder="Enter your number" required>
					</div>
					<div class="form-group">
						<label><b>Password</b></label>
						<input type="password" class="form-control" name="password" placeholder="Enter password" required>
					</div>
					<div class="form-group">
						<label><b>Confirm Password</b></label>
						<input type="password" class="form-control" name="password2" placeholder="Enter password Again" required>
					</div>
					<div class="form-group text-center">
						<input type="submit" class="btn btn-lg btn-success mr-auto" name="registerSubmit" value="Register">
					</div>
				</form>
				<div class="text-center">
					<a href="login.php">Login</a>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
<script type="text/javascript" src="js/script.js"></script>