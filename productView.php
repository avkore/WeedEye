<?php
@include 'config.php';
?>
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
	$pId = $_GET['id'];
	$sql = "SELECT * FROM products WHERE id=$pId";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		$product_name = $row["name"];
		$price = $row["price"];
		$productQuantity = $row["instock"];

		if ($row['instock'] == 0) {
			$instock = "No";
		} else if ($row['instock'] > 0) {
			$instock = "Yes";
		}

		$thc = $row["THC"];
		$height = $row["Height"];
		$flTime = $row["flowering_time"];
		$genetics = $row["Genetics"];
		$description = $row["description"];
	}
	?>

	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>See more Details</p>
						<h1><?php echo $product_name; ?></h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- single product -->
	<div class="single-product mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-md-5">
					<div class="single-product-img">
						<img src="AdminPanel/dist/productImageView.php?image_id=<?php echo $pId; ?> " alt="">
					</div>
				</div>
				<div class="col-md-7">
					<div class="single-product-content">
						<h2 class="orange-text"><?php echo $product_name; ?></h2>
						<p class="single-product-pricing">₾<?php echo $price; ?></p>
						<p><strong>THC: </strong><?php echo $thc; ?>%</p>
						<p><strong>In Stock: </strong><?php echo $instock; ?></p>
						<p><strong>Height: </strong><?php echo $height; ?> cm</p>
						<p><strong>Genetics: </strong><?php echo $genetics; ?></p>
						<p><strong>Flowering Time: </strong><?php echo $flTime; ?> Week</p>
						<?php
						if (isset($_SESSION['id'])) {
							$user_id = $_SESSION['id'];
							$product_id = $_GET['id'];
							$query = "SELECT * FROM card_items WHERE user_id=$user_id AND product_id=$product_id AND submited=0";
							$tempQuantity = 0;
							$result = mysqli_query($conn, $query);
							if (mysqli_num_rows($result) > 0) {
								$row = mysqli_fetch_row($result);
								$tempQuantity = $row[3];
							}

							if (isset($_POST["addProductToCartBtn"])) {
								$quantity = $_POST['productQuantity'];

								if (mysqli_num_rows($result) > 0) {
									$sql = "UPDATE card_items SET quantity=$quantity WHERE user_id=$user_id AND product_id=$product_id";
									mysqli_query($conn, $sql);
									$tempQuantity = $quantity;
								} else {
									$insert = "INSERT INTO card_items(user_id, product_id, quantity) VALUES('$user_id', '$product_id', '$quantity')";
									mysqli_query($conn, $insert);
									$tempQuantity = $quantity;
								}
							}
						}

						?>
						<div class="single-product-form">
							<form action="" method="post">
								<input name="productQuantity" max="<?php echo $productQuantity; ?>" type="number" class="myInput" min="0" value="<?php echo $tempQuantity; ?>"><br>
								<button class="cart-btn" type="submit" name="addProductToCartBtn"><i class="fas fa-shopping-cart"></i>Add To Cart</button>
							</form>
						</div>
						<!-- <p>We created our cup-winning Amnesia Flash from the best Dutch strains, which where chosen for their strength and intense. Amnesia Flash is perfectly suitable both, for outdoors as well as for indoors. It has a strong growth and is very resistant against mildew and parasites, therefore it is very popular for beginners and experienced growers as well. Amnesia Flash needs 65 days flowering time in the grow room – outdoor, it can be harvested in mid-October. She throws off monstrous yields of 700 grams per square meter and more than 1000 g per plant in sunny areas.</p> -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end single product -->

	<div class="row">
		<div class="col-lg-12 text-center">
			<div class="section-title-2">
				<h3><span class="orange-text">Description</h3>
				<p><?php echo $description; ?></p>
			</div>
		</div>
	</div>

	<!-- more products -->
	<div class="more-products mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">
						<h3><span class="orange-text">Related</span> Products</h3>
						<p>Find Best Product Which Suits You</p>
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
							<button type="submit" name="addtocard" onclick="sendVariable('<?php echo $row[0]; ?>');" class="addToCart btn text-center">
								<a class="btn text-center"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
							</button>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<!-- end more products -->

	<script>
		// Define the function that sends the variable to the server
		function sendVariable(variable) {
			$.ajax({
				type: "POST",
				url: "addToCart.php",
				data: {
					item: 'item',
					variable: variable
				},
				success: function(response) {
					// window.location.reload();
					//console.log("Variable sent successfully: " + response);
				}
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