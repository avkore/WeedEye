<!DOCTYPE html>
<html lang="en">
<?php
include('parts/head.php');
?>

<?php

@include 'config.php';

if (isset($_POST['submit'])) {

	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$pass = md5($_POST['password']);
	$cpass = md5($_POST['cpassword']);
	$email = $_POST['email'];
	$name = $_POST['name'];

	$select = " SELECT * FROM users WHERE email = '$email'";

	$result = mysqli_query($conn, $select);

	if (mysqli_num_rows($result) > 0) {
		echo "<script type='text/javascript'>alert('A user with this email already exists');</script>";
		$error[] = 'მომხმარებელი უკვე არსებობს!';
	} else {
		$insert = "INSERT INTO users(name, email, password) VALUES('$name', '$email', '$pass')";
		mysqli_query($conn, $insert);
		header('location:Login.php');
	}
}
?>

<body class="bg-image">

	<!--PreLoader-->
	<div class="loader">
		<div class="loader-inner">
			<div class="circle"></div>
		</div>
	</div>
	<!--PreLoader Ends-->

	<div class="container h-100">
		<div class="row h-100 justify-content-center align-items-center">
			<div class="col-lg-5 col-md-7 col-sm-9">
				<div class="card p-5 shadow-lg">
					<h2 class="text-center">Registration</h2>
					<form action="" method="post">
					<div class="form-group">
							<label for="username">Full Name</label>
							<input type="text" name="name" class="form-control" id="Email" placeholder="Enter Name" required>
						</div>
						<div class="form-group">
							<label for="username">Email</label>
							<input type="email" name="email" class="form-control" id="Email" placeholder="Enter Email" required>
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required onChange="onChange()" minlength="8">
						</div>
						<div class="form-group">
							<label for="password">Confirm Password</label>
							<input type="password" name="cpassword"  class="form-control" id="password" placeholder="Enter password" required onChange="onChange()">
						</div>
						
						
						<button type="submit" name="submit" class="btn-lg btn-primary btn-block">Sign Up</button>
						<div>
							<a class="small" href="Login.php">Already Have an account? Log In!</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script>
		function onChange() {
			const password = document.querySelector('input[name=password]');
			const confirm = document.querySelector('input[name=cpassword]');
			if (confirm.value === password.value) {
				confirm.setCustomValidity('');
			} else {
				confirm.setCustomValidity('Passwords do not match');
			}
		}
	</script>

	<!-- scripts -->
	<?php
	include('parts/script.php');
	?>
	<!-- scripts -->

</body>
</html>