<!DOCTYPE html>
<html lang="en">
<?php
include('parts/head.php');
?>

<body>

	<!--PreLoader-->
	<div class="loader">
		<div class="loader-inner">
			<div class="circle"></div>
		</div>
	</div>
	<!--PreLoader Ends-->

	<!-- header -->
	<?php
	include('parts/header.php');
	?>
	<!-- end header -->

	<!-- search area -->
	<?php
	include('parts/search.php');
	?>
	<!-- end search arewa -->

	<?php

	use PHPMailer\PHPMailer\PHPMailer;

	require 'vendor/PHPMailer-master/src/Exception.php';
	require 'vendor/PHPMailer-master/src/PHPMailer.php';
	require 'vendor/PHPMailer-master/src/SMTP.php';

	function function_alert($msg)
	{
		echo "<script type='text/javascript'>alert('$msg');</script>";
	}

	if (isset($_POST["submit"])) {
		if (isset($_POST["message"]) && (!empty($_POST["message"]))) {
			$output = $_POST['message'];
			$subject = $_POST['subject'];

			$body = $output;
			$subject = $subject;

			$email = ""; // Enter your email here
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

			$mail->From = $_SESSION['email'];
			$mail->FromName = $_SESSION['name'];

			$mail->Sender = $fromserver; // indicates ReturnPath header
			$mail->Subject = $subject;
			$mail->Body = $body;
			$mail->AddAddress($email_to);
			if (!$mail->Send()) {
				echo "Mailer Error: " . $mail->ErrorInfo;
			} else {
				$msg1 = "You Have Successfuly Sent Message To Support Team";
				function_alert($msg1);
				echo ("<script>location.href='index.php'</script>");
			}
		}
	}
	?>

	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>Get 24/7 Support</p>
						<h1>Contact us</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- contact form -->
	<div class="contact-from-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 mb-5 mb-lg-0">
					<div class="form-title">
						<h2>Do you have any question?</h2>
						<p>We're here to help! Please don't hesitate to reach out to us for any inquiries or concerns. Our friendly customer support team is available to assist you.</p>
					</div>
					<div id="form_status"></div>
					<div class="contact-form">
						<form method="POST" id="fruitkha-contact" onSubmit="return valid_datas( this );">
							<p>
								<input type="text" placeholder="name" name="name" id="name">
								<input type="email" placeholder="email" name="email" id="email">
							</p>
							<p>
								<input type="tel" placeholder="Phone" name="phone" id="phone">
								<input type="text" placeholder="Subject" name="subject" id="subject">
							</p>
							<p><textarea name="message" id="message" cols="30" rows="10" placeholder="Message"></textarea></p>
							<input type="hidden" name="token" value="FsWga4&@f6aw" />
							<p><input type="submit" name="submit" value="Submit"></p>
						</form>
					</div>
				</div>
				<div class="col-lg-4 mt-100">
					<div class="contact-form-wrap">
						<div class="contact-form-box">
							<h4><i class="fas fa-map"></i> Shop Address</h4>
							<p>Tbilisi<br> Georgia <br></p>
						</div>
						<div class="contact-form-box">
							<h4><i class="far fa-clock"></i> Shop Hours</h4>
							<p>MON - FRIDAY: 8 to 9 PM <br> SAT - SUN: 10 to 8 PM </p>
						</div>
						<div class="contact-form-box">
							<h4><i class="fas fa-address-book"></i> Contact</h4>
							<p>Phone: +995 551 631 789<br> Email: Support@Weedeye.com</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end contact form -->

	<!-- find our location -->
	<div class="find-location blue-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<p> <i class="fas fa-map-marker-alt"></i> Find Our Location</p>
				</div>
			</div>
		</div>
	</div>
	<!-- end find our location -->

	<!-- google map section -->
	<div class="embed-responsive embed-responsive-21by9">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d190637.14450411563!2d44.81688019375003!3d41.7052954134257!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40440cd7e64f626b%3A0x61d084ede2576ea3!2z4YOX4YOR4YOY4YOa4YOY4YOh4YOY!5e0!3m2!1ska!2sge!4v1676070297022!5m2!1ska!2sge" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" class="embed-responsive-item"></iframe>
	</div>
	<!-- end google map section -->


	<!-- footer -->
	<?php
	include('parts/footer.php');
	?>
	<!-- end footer -->

	<!-- scripts -->
	<?php
	include('parts/script.php');
	?>

</body>

</html>