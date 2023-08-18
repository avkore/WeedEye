<!DOCTYPE html>
<html lang="en">
<?php
include('parts/head.php');
?>


<body class="bg-image">

	<!--PreLoader-->
	<div class="loader">
		<div class="loader-inner">
			<div class="circle"></div>
		</div>
	</div>
	<!--PreLoader Ends-->

	<?php
	include('config.php');

	use PHPMailer\PHPMailer\PHPMailer;

	require 'PHPMailer-master/src/Exception.php';
	require 'PHPMailer-master/src/PHPMailer.php';
	require 'PHPMailer-master/src/SMTP.php';

	function function_alert($msg)
	{
		echo "<script type='text/javascript'>alert('$msg');</script>";
	}

	if (isset($_POST["email"]) && (!empty($_POST["email"]))) {
		$email = $_POST["email"];
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		$email = filter_var($email, FILTER_VALIDATE_EMAIL);
		$error = "";

		if (!$email) {
			$error .= "<p>Invalid email address please type a valid email address!</p>";
		} else {
			$sel_query = "SELECT * FROM `users` WHERE email='" . $email . "'";
			$results = mysqli_query($conn, $sel_query);
			$row = mysqli_num_rows($results);
			if ($row == "") {
				$error .= "No user is registered with this email address!";
			}
		}
		if ($error != "") {
			function_alert($error);
			echo ("<script>location.href='ForgotPasword.php'</script>");
		} else {
			$expFormat = mktime(
				date("H"),
				date("i"),
				date("s"),
				date("m"),
				date("d") + 1,
				date("Y")
			);
			$expDate = date("Y-m-d H:i:s", $expFormat);
			$TempPass = md5($email);
			$addKey = substr(md5(uniqid(rand(), 1)), 3, 10);
			$TempPass = $TempPass . $addKey;
			// Insert Temp Table
			mysqli_query($conn, "INSERT INTO `password_reset_temp` (`email`, `TempPass`, `expDate`) VALUES ('" . $email . "', '" . $TempPass . "', '" . $expDate . "');");

			$output = '<p>Dear user,</p>';
			$output .= '<p>Please click on the following link to reset your password.</p>';
			$output .= '<p>-------------------------------------------------------------</p>';
			$output .= '<p><a href="https://localhost/demo/WeedEye/ResetPassword.php?key=' . $TempPass . '&email=' . $email . '&action=reset" target="_blank">
		  https://localhost/demo/WeedEye/ResetPassword.php?key=' . $TempPass . '&email=' . $email . '&action=reset</a></p>';
			$output .= '<p>-------------------------------------------------------------</p>';
			$output .= '<p>Please be sure to copy the entire link into your browser.
	The link will expire after 1 day for security reason.</p>';
			$output .= '<p>If you did not request this forgotten password email, no action 
	is needed, your password will not be reset. However, you may want to log into 
	your account and change your security password as someone may have guessed it.</p>';
			$output .= '<p>Thanks,</p>';
			$output .= '<p>WeedEye Team</p>';
			$body = $output;
			$subject = "Password Recovery - WeedEye";

			$email_to = $email;
			$fromserver = "Support@Weedeye.com";

			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->Host = "smtp-relay.sendinblue.com"; // Enter your host here
			$mail->SMTPAuth = true;
			$mail->Username = ""; // Enter your email here
			$mail->Password = ""; //Enter your password here
			$mail->Port = 587;
			$mail->IsHTML(true);
			$mail->From = "Support@weedeye.com";
			$mail->FromName = "WeedEye";
			$mail->Sender = $fromserver; // indicates ReturnPath header
			$mail->Subject = $subject;
			$mail->Body = $body;
			$mail->AddAddress($email_to);
			if (!$mail->Send()) {
				echo "Mailer Error: " . $mail->ErrorInfo;
			} else {
				$msg1 = "An email has been sent to you with instructions on how to reset your password.";
				function_alert($msg1);
				echo ("<script>location.href='login.php'</script>");
			}
		}
	}
	?>


	<div class="container h-100">
		<div class="row h-100 justify-content-center align-items-center">
			<div class="col-lg-5 col-md-7 col-sm-9">
				<div class="card p-5 shadow-lg">
					<h3 class="text-center">Lets Get Your Account Back!</h3>
					<form action="" method="post">
						<div class="form-group">
							<label for="username">Email</label>
							<input type="email" name="email" class="form-control" id="Email" placeholder="Enter Email" required>
						</div>
						<button type="submit" name="submit" class="btn-lg btn-primary btn-block">Send</button>
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