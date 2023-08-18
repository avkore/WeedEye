<!DOCTYPE html>
<?php

@include 'config.php';
session_start();
?>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>

<body>


	<div class="top-header-area" id="sticker">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 text-center">
					<div class="main-menu-wrap">
						<!-- logo -->
						<div class="site-logo">
							<a href="index.php">
								<img src="assets/img/LogoHorizontal.png" alt="">
							</a>
						</div>
						<!-- logo -->

						<!-- menu start -->
						<nav class="main-menu">
							<?php
							if (isset($_SESSION['id']) && $_SESSION["account_type"] == '0') {
								$var = "profile.php";
							} else if (isset($_SESSION['id']) && $_SESSION["account_type"] == '1') {
								$var = "AdminPanel/dist/index.php";
							} else {
								$var = "Login.php";
							}
							?>
							<ul>
								<li><a href="index.php">Home</a></li>
								<li><a class="desktop-hide" href="profile.php">Account</a></li>
								<li><a href="about.php">About</a></li>
								<li><a href="shop.php?sort=id">Shop</a></li>
								<li><a href="instruction.php">Insturction</a></li>
								<li><a href="news.php">Blog</a></li>
								<li><a href="contact.php">Contact</a></li>

								<li>
									<div class="header-icons">
										<a class="mobile-hide  shopping-cart " href="cart.php">
											<?php
											if (isset($_SESSION['id'])) {
												$id = $_SESSION['id'];}
											elseif (isset($_COOKIE['id']) && !isset($_SESSION['id'])) {
												$id = $_COOKIE['id'];
											}
											$count = "SELECT * from card_items WHERE user_id=$id AND submited=0";
											if ($resultcount = mysqli_query($conn, $count)) {
												$total_orders = mysqli_num_rows($resultcount);
											}
											else{
												$total_orders = 0;
											}
											?>
											<div class="notifications" id="notify"><?php echo $total_orders ?></div> <i class="fas fa-shopping-cart"></i>
										</a>
										<a class="mobile-hide search-bar-icon" href="#"><i class="fas fa-search"></i></a>
										<a class="mobile-hide  account" href="<?php echo $var ?>"><i class="fas fa-user"></i></a>
									</div>
								</li>
							</ul>
						</nav>
						<a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
						<div class="mobile-menu"></div>
						<!-- menu end -->
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="assets\js\header.js"></script>
</body>

</html>