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
						<p>We Sell Best Seeds</p>
						<h1>How To Buy Our Products</h1>
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
						<div class="row">
							<div class="col-lg-9 col-md-9">
								<h3 class="pb-3">1. Navigate To Shop</h3>
								<img src="assets/img/Instruction/Instruction1.PNG" alt="Instruction Image 1" class="img-fluid">
								<p class="mt-4">Once on the website, locate the Shop link. This could be in the main navigation menu at the top of the page or just simply click <a href="shop.php?sort=id">here</a>.</p>
							</div>
							<div class="col-lg-9 col-md-9 mt-5">
								<h3 class="pb-3">2. Choose Your Product</h3>
								<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
									<div class="carousel-inner">
										<div class="carousel-item active">
											<img class="d-block w-100" src="assets/img/Instruction/Instruction2.PNG" alt="First slide">
										</div>
										<div class="carousel-item">
											<img class="d-block w-100" src="assets/img/Instruction/Instruction3.PNG" alt="Second slide">
										</div>
									</div>
								</div>
								<p class="mt-4">On the shop page, you can browse the products available for purchase. You can click on a specific product to learn more about it and add it to cart if you want to make a purchase or just click add to cart button specified in first picture.</p>
							</div>
							<div class="col-lg-9 col-md-9 mt-5">
								<h3 class="pb-3">3. Check Your Cart</h3>
								<img src="assets/img/Instruction/Instruction4.PNG" alt="Instruction Image 4" class="img-fluid">
								<p class="mt-4">Go and Check Your Cart. This could be in the main navigation menu at the top of the page or just simply click <a href="cart.php">here</a>.</p>
							</div>
							<div class="col-lg-9 col-md-9 mt-5">
								<h3 class="pb-3">4. Make Sure You Have Right Products</h3>
								<img src="assets/img/Instruction/Instruction5.PNG" alt="Instruction Image 5" class="img-fluid">
								<p class="mt-4">Please Make Sure That You have Your Desired Products In Your Cart. After Checking Your Products List, Press On Checkout Button Marked In The Picture.</p>
							</div>
							<div class="col-lg-9 col-md-9 mt-5">
								<h3 class="pb-3">5. Checkout</h3>
								<img src="assets/img/Instruction/Instruction6.PNG" alt="Instruction Image 6" class="img-fluid">
								<p class="mt-4">After Pressing On The CheckOut Button You will be automaticaly Moved To Details Section. To Get Your Fresh and Best Quality Seeds, Fill All The Required Data,
									Such As Name, Email, Address And Phone Number. After Submiting The Order, Our Supports Will Contact You. Do Not Worry About Security, Your Details Will Be Only Visible To Our Supports. Warning: Always Double Check Your Details. If You have
									Already Made Order With Wrong Details, Please Message Support Team From <a href="contact.php">Here</a>.
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end featured section -->


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