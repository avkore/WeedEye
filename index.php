<?php
@include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<?php
include('parts/head.php');

if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $_SERVER['REQUEST_URI'])) {
	header("HTTP/1.0 404 Not Found");
	include('404.php');
	exit();
}

if (!isset($_COOKIE['id']) && !isset($_SESSION['id'])) {
	$pass = "password";
	$email = "test@gmail.com";
	$name = "TempUser";
	$expirationTime = time() + 86400;

	$insert = "INSERT INTO users(name, email, password) VALUES('$name', '$email', '$pass')";
	mysqli_query($conn, $insert);

	// Retrieve the auto-generated ID of the inserted row
	$id = mysqli_insert_id($conn);

	// Set the 'cookie_name' cookie with the fetched ID value
	setcookie('id', $id, $expirationTime);
}
?>


<body>

	<div class="warning-container" id="warningContainer">
		<div class="warning-content">
			<div>
				<h1 class="warnig-heading">ADULT CONTENT - AGE RESTRICTED</h1>
				<p class="warning-p">Please confirm that you're over 18 or <br><span>leave</span> the website</p>
			</div>

			<div class="warning-buttons">
				<button class="over18btn" id="over18Btn">I'm over 18</button>
				<a href="https://www.youtube.com/watch?v=t0Q2otsqC4I"><button class="leavesitebtn" id="leaveBtn">Exit</button></a>
			</div>
		</div>
	</div>
	
	<!--additional CSS-->
	<style>
		.out-of-stock-label {
			position: absolute;
			background-color: red;
			color: white;
			padding: 5px;
			z-index: 1;
		}
	</style>
	<!--additional CSS-->

	<!-- header -->
	<?php
	include('parts/header.php');
	?>
	<!-- end header -->

	<!-- search area -->
	<?php
	include('parts/search.php');
	?>
	<!-- end search area -->

	<!-- hero area -->
	<div class="hero-area hero-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 offset-lg-2 text-center">
					<div class="hero-text">
						<div class="hero-text-tablecell">
							<p class="subtitle">Fresh & Organic</p>
							<h1>Best Seasonal Products</h1>
							<div class="hero-btns">
								<a href="shop.php?sort=id" class="boxed-btn">Start Shopping</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end hero area -->

	<!-- features list section -->
	<div class="list-section pt-80 pb-80">
		<div class="container">

			<div class="row">
				<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
					<div class="list-box d-flex align-items-center">
						<div class="list-icon">
							<i class="fas fa-shipping-fast"></i>
						</div>
						<div class="content">
							<h3>Free Shipping</h3>
							<p>When order over ₾75</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
					<div class="list-box d-flex align-items-center">
						<div class="list-icon">
							<i class="fas fa-phone-volume"></i>
						</div>
						<div class="content">
							<h3>24/7 Support</h3>
							<p>Get support all day</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="list-box d-flex justify-content-start align-items-center">
						<div class="list-icon">
							<i class="fas fa-medal"></i>
						</div>
						<div class="content">
							<h3>Best Quality</h3>
							<p>Get High Quality Seeds within 3 days!</p>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- end features list section -->

	<!-- product section -->
	<div class="product-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">
						<h3><span class="orange-text">Our</span> Products</h3>
					</div>
				</div>
			</div>

			<div class="row">
				<?php
				$sql = "SELECT * FROM products ORDER BY id DESC LIMIT 4";
				$result = mysqli_query($conn, $sql);
				while ($row = mysqli_fetch_array($result)) { ?>
					<div class="col-lg-3 col-md-6">
						<div class="single-latest-news">
							<?php if ($row[5] <= 0) : ?>
								<div class="out-of-stock-label">Out of Stock</div>
							<?php endif; ?>
							<a href="productView.php?id=<?php echo $row[0]; ?>"><img class="latest-news-bg" id="MediaImg" width="100%" height="180" src="AdminPanel/dist/productImageView.php?image_id=<?php echo $row[0]; ?> "></a>
							<div class="news-text-box">
								<h3><?php echo $row[1] ?></h3>
								<p class="blog-meta">
									<span class="author"><i class="fas fa-flask"></i> THC <?php echo $row[6]; ?> %</span><br>
									<span class="author"><i class="fas fa-clock"></i> <?php echo $row[8]; ?> Week</span><br>
									<span class="author"><i class="fas fa-arrow-up"></i> <?php echo $row[7]; ?> cm</span><br>
									<span class="author"><i class="fas fa-dna"></i> <?php echo $row[9]; ?></span>
								</p>
								<p class="product-price excerpt"> <?php echo $row[3]; ?> ₾ </p>
							</div>
							<button type="submit" name="addtocard" onclick="sendVariable('<?php echo $row[0]; ?>', '<?php echo $row['instock']; ?>');" class="addToCart btn text-center">
								<a class="btn text-center"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
							</button>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<!-- end product section -->

	<!-- cart banner section -->
	<section class="cart-banner pt-100 pb-100">
		<div class="container">
			<div class="row clearfix">
				<!--Image Column-->
				<div class="image-column col-lg-6">
					<div class="image">
						<div class="price-box">
							<div class="inner-price">
								<span class="price">
									<strong>30%</strong> <br> off per seed
								</span>
							</div>
						</div>
						<img src="assets/img/products/istockphoto-182758951-612x612.png" alt="">
					</div>
				</div>
				<!--Content Column-->
				<div class="content-column col-lg-6">
					<h3><span class="orange-text">Deal</span> of the month</h3>
					<h4>Black Cherry Punch</h4>
					<div class="text">Sour Apple was created by an intersection of the original Sour Diesel and a Pure Kush. It is an indica dominant hybrid with a combination of both indica and sativa effects. It has an delicious intense taste of sour apples and lemon and a gigantic potency.</div>
					<!--Countdown Timer-->

					<a href="shop.php?sort=id" class="cart-btn mt-3"><i class="fas fa-shopping-cart"></i> Shop</a>
				</div>
			</div>
		</div>
	</section>
	<!-- end cart banner section -->

	<!-- testimonail-section -->
	<div class="testimonail-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1 text-center">
					<div class="testimonial-sliders">
						<div class="single-testimonial-slider">
							<div class="client-avater">
								<img src="assets/img/avatars/avatar1.jpg" alt="">
							</div>
							<div class="client-meta">
								<h3>Tyler Seabolt <span>Local shop owner</span></h3>
								<p class="testimonial-body">
									" Excellent customer support and speedy delivery. My new number one shop that I will definitely continue to support. Very grateful "
								</p>
							</div>
						</div>
						<div class="single-testimonial-slider">
							<div class="client-avater">
								<img src="assets/img/avatars/avatar2.jpg" alt="">
							</div>
							<div class="client-meta">
								<h3>David Roosevelt <span>Loyal Customer</span></h3>
								<p class="testimonial-body">
									" Excellent service as usual! Seeds popped out taproots between damp kitchen roll after a 24 hour soak. All look very strong in 1” rockwool cubes/tray, in heated propagator all about 2-3inches in height after 4 days "
								</p>
							</div>
						</div>
						<div class="single-testimonial-slider">
							<div class="client-avater">
								<img src="assets/img/avatars/avatar3.jfif" alt="">
							</div>
							<div class="client-meta">
								<h3>June Bush <span>User</span></h3>
								<p class="testimonial-body">
									" Thank you Weedeye for the good help over the e-mail and also for the fast and discreet delivery! I've put the Original Gorilla 4# yesterday in the water and today all 3 beans have already popped "
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end testimonail-section -->

	<!-- advertisement section -->
	<div class="abt-section mt-150 mb-150 ">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-12">
					<div class="abt-bg">

						<a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class="video-play-btn popup-youtube "><i class="fas fa-play"></i></a>
					</div>
				</div>
				<div class="col-lg-6 col-md-12">
					<div class="abt-text">
						<p class="top-sub">Since Year 2022</p>
						<h2>We are <span class="orange-text">WeedEye</span></h2>
						<p>We believe in what we do and we only settle for the best. Our quality is the result of years of research and advanced breeding programs. We do not shy away from costs and efforts to bring the best and most potent genetics to the market.</p>
						<p>WeedEye develops the latest generation of highly potent and amazing productive cannabis strains. Your order reaches you super quickly and absolutely neutral. All orders have a tracking number.</p>
						<a href="about.php" class="boxed-btn mt-4">Know More</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end advertisement section -->

	<!-- shop banner -->
	<section class="shop-banner">
		<div class="container">
			<div class="row">
				<div class="col-sm-8">
					<h3>February sale is on! <br> with big <span class="orange-text">Discount</span></h3>
					<div class="sale-percent"><span>Sale! <br> Up to</span>20% <span></span></div>
					<a href="shop.php?sort=id" class="cart-btn btn-lg">Shop Now</a>
				</div>
				<div class="col-sm-4 image-column">
					<img src="assets/img/shop-banner.png" class="img-fluid" alt="Image">
				</div>
			</div>
		</div>
	</section>
	<!-- end shop banner -->

	<!-- latest news -->
	<div class="latest-news pt-150 pb-150">
		<div class="container">

			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">
						<h3><span class="orange-text">Our</span> News</h3>
						<p>The latest cannabis news today, including what’s new in politics and pop culture, information, lifestyle tips, and more.</p>
					</div>
				</div>
			</div>

			<div class="row">
				<?php
				$sql = "SELECT * FROM blogs ORDER BY id DESC LIMIT 3";
				$result = mysqli_query($conn, $sql);
				while ($row = mysqli_fetch_array($result)) { ?>
					<div class="col-lg-4 col-md-6">
						<div class="single-latest-news testClass">
							<div class="shit">
								<a href="blogView.php?id=<?php echo $row[0]; ?>">
									<div class="latest-news-bg news-bg-1"><a href="blogView.php?id=<?php echo $row[0]; ?>"><img class="latest-news-bg" id="MediaImg" width="100%" height="180" src="AdminPanel/dist/blogImageView.php?image_id=<?php echo $row[0]; ?> "></a></div>
								</a>
								<div class="news-text-box">
									<h3><a href="single-news1.php"><?php echo $row[1]; ?></a></h3>
									<p class="blog-meta">
										<span class="author"><i class="fas fa-user"></i> Admin</span>
										<span class="date"><i class="fas fa-calendar"></i><?php echo $row[4]; ?></span>
									</p>
									<div class="bigText">
										<p class="excerpt" maxlength="12"><?php echo $row[2] ?></p>
									</div>
								</div>
							</div>
							<div>
								<a href="single-news1.php" class="read-more-btn">read more <i class="fas fa-angle-right"></i></a>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
			<div class="row">
				<div class="col-lg-12 text-center">
					<a href="news.php" class="boxed-btn">More News</a>
				</div>
			</div>
		</div>
	</div>
	<!-- end latest news -->

	<script>
		// Define the function that sends the variable to the server
		function sendVariable(variable, instock) {
			//alert(variable);
			// Send the variable to the server using jQuery's AJAX function
			if (instock == 0) {
				alert("Product Not In Stock");
			}
			$.ajax({
				type: "POST",
				url: "addToCart.php",
				data: {
					item: 'item',
					variable: variable,
					instock: instock
				},
				success: function(response) {
					window.location.reload();
					//console.log("Variable sent successfully: " + response);
				},
			});

		}
	</script>

	<!-- logo carousel -->
	<?php
	include('parts/logoCarousel.php');
	?>
	<!-- end logo carousel -->

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