<!DOCTYPE html>
<html lang="en">
<?php
include('parts/head.php');
?>

<?php

@include 'config.php';

session_start();

if (isset($_POST['submit'])) {

	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$pass = md5($_POST['password']);

	$select = " SELECT * FROM users WHERE  email = '$email' && password = '$pass' ";

	$result = mysqli_query($conn, $select);


	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_array($result);
		$_SESSION['id'] = $row[0];
		$_SESSION['name'] = $row[1];
		$_SESSION['email'] = $row[2];
		$_SESSION['password'] = $row[7];
		$_SESSION['account_type'] = $row[8];
		$_SESSION['phone'] = $row[3];
		$_SESSION['address'] = $row[4];
		$_SESSION['region'] = $row[5];
		$_SESSION['zipCode'] = $row[6];

		if ($row['account_type'] == '0') {
			header('location:index.php');
		} elseif ($row['account_type'] == '1') {
			header('location:AdminPanel/dist/index.php');
		}
	} else {
		echo "<script type='text/javascript'>alert('The email address or password is incorrect. Please try again');</script>";
		$error[] = 'მომხმარებლის სახელი ან პაროლი არასწორია!';
	}
};
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
					<h2 class="text-center">Welcome Back!</h2>
					<form action="" method="post">
						<div class="form-group">
							<label for="username">Email</label>
							<input type="email" name="email" class="form-control" id="Email" placeholder="Enter Email" required>
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required>
							<a class="small" href="ForgotPasword.php">Forgot Password?</a>
						</div>
						
						
						<button type="submit" name="submit" class="btn-lg btn-primary btn-block">Sign In</button>
						<div>
							<a class="small" href="Registrate.php">Don't Have an account? Create One!</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- scripts -->
	<?php
	include('parts/script.php');
	?>

</body>

<script>
	function errorOff() {
		var img = document.getElementById("formError");
		if (img.style.display = "block") {
			img.style.display = "none"
		} else {
			img.style.display = "none"
		}
	}
</script>

</html>