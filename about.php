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

	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>We Sell Best Products</p>
						<h1>About Us</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- featured section -->
	<div class="mt-100 mb-100">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 d-flex justify-content-center">
					<div class="featured-text">
						<h2 class="pb-3 text-center">Why <span class="orange-text">WeedEye</span></h2>
						<div class="row mt-100">
							<div class="col-lg-6 col-md-6 mb-4 mb-md-5">
								<div class="list-box d-flex">
									<div class="list-icon">
										<i class="fas fa-shipping-fast"></i>
									</div>
									<div class="content">
										<h3>Home Delivery</h3>
										<p>Enjoy the convenience of shopping from your couch with our fast and reliable home delivery service! We understand the importance of flexibility, which is why we offer home delivery so you can receive your order at the comfort of your own home. Shop now and take advantage of this hassle-free option</p>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 mb-5 mb-md-5">
								<div class="list-box d-flex">
									<div class="list-icon">
										<i class="fas fa-money-bill-alt"></i>
									</div>
									<div class="content">
										<h3>Best Price</h3>
										<p>Get the best deals on premium cannabis products at WeedEye. Our commitment to providing top-notch quality at affordable prices sets us apart from the competition. Shop with us today and discover unbeatable prices on all your favorite strains and products</p>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 mb-5 mb-md-5">
								<div class="list-box d-flex">
									<div class="list-icon">
										<i class="fas fa-briefcase"></i>
									</div>
									<div class="content">
										<h3>Custom Box</h3>
										<p>We understand the importance of ensuring that your purchases arrive safely and securely. That's why we use only the best packaging materials to protect your products during shipping. Our state-of-the-art packaging process ensures that your items are packaged with the utmost care and attention to detail, so that they arrive in perfect condition</p>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="list-box d-flex">
									<div class="list-icon">
										<i class="fas fa-sync-alt"></i>
									</div>
									<div class="content">
										<h3>Quick Refund</h3>
										<p>At WeedEye, we stand behind our products 100%. That's why we offer a fair and easy refund policy, so you can shop with confidence. If for any reason you're not completely satisfied with your purchase, simply reach out to us within [x days] and we'll make it right. Quick and hassle-free, just like our returns</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end featured section -->


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
					<img src="assets/img/istockphoto-1159007563-612x612.png" class="img-fluid" alt="Image">
				</div>
			</div>
		</div>
	</section>
	<!-- end shop banner -->

	<div class="container my-5">
		<h2 class="text-center orange-text">About Us</h2>
		<div class="row mt-80">
			<div class="col-md-6 feature-bg">
				<!-- <img src="assets/img/LogoFull.png" alt="Image"> -->
			</div>
			<div class="col-md-6">
				<h3>Our Mission</h3>
				<p>Our mission is to provide top-quality cannabis products to our customers in a safe, secure, and welcoming environment. We believe in the power of cannabis to improve people's lives, and we are dedicated to educating our customers and promoting responsible use. </p>
				<h3>Our Products</h3>
				<p>We offer a wide range of cannabis products, including flowers, edibles, concentrates, and topicals. All of our products are carefully selected for their quality, potency, and effectiveness, and we only work with trusted suppliers who share our commitment to excellence. </p>
			</div>
		</div>
	</div>


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