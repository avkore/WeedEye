<!DOCTYPE html>
<html lang="en">
<?php
include('parts/head.php');
?>

<body>
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
						<p>Fresh and Organic</p>
						<h1>Shop</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- products -->
	<div class="product-section mt-150 mb-150">
		<div class="container">

			<div class="row">

				<div class="col-md-12">
					<div class="product-filters">
						<ul>
							<a class="active" href="shop.php?sort=id">
								<li class="active">All</li>
							</a>
							<a href="shop.php?sort=THC">
								<li>THC</li>
							</a>
							<a href="shop.php?sort=price">
								<li>Price</li>
							</a>
							<a href="shop.php?sort=flowering_time">
								<li>Flowering Time</li>
							</a>
						</ul>
					</div>
				</div>

			</div>

			<div class="row product-lists">


				<?php
				$sort = $_GET['sort'];
				$limit = 8;
				if (isset($_GET["page"])) {
					$page  = $_GET["page"];
				} else {
					$page = 1;
				};
				$start_from = ($page - 1) * $limit;


				if (isset($_GET['name'])) {
					$productName = $_GET['name'];
					$sql = "SELECT * FROM products WHERE name LIKE '%" . $productName . "%' ORDER BY $sort ASC LIMIT $start_from, $limit";
				} else {
					$sql = "SELECT * FROM products ORDER BY $sort ASC LIMIT $start_from, $limit";
				}
				$total_records = 1;
				$rs_result = mysqli_query($conn, $sql);
				while ($row = mysqli_fetch_array($rs_result)) { ?>
					<div class="col-lg-3 col-md-6">
						<div class="single-latest-news">
							<a href="productView.php?id=<?php echo $row[0]; ?>"><img class="latest-news-bg" id="MediaImg" width="100%" height="180" src="AdminPanel/dist/productImageView.php?image_id=<?php echo $row[0]; ?> "></a>
							<?php if ($row[5] <= 0) : ?>
								<div class="out-of-stock-label">Out of Stock</div>
							<?php endif; ?>
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
							<!-- <button class="addToCart">
								<a href="cart.php" class="btn text-center"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
							</button> -->
							<button type="submit" name="addtocard" onclick="sendVariable('<?php echo $row[0]; ?>', '<?php echo $row['instock']; ?>');" class="addToCart btn text-center">
								<a class="btn text-center"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
							</button>
						</div>
					</div>
				<?php
					$total_records += 1;
				} ?>
			</div>

			<link rel="stylesheet" id="font-awesome-style-css" href="http://www.phpflow.com/code/css/bootstrap3.min.css" type="text/css" media="all">
			<!-- jQuery -->
			<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>

			<?php
			$limit = 8;
			$total_pages = ceil($total_records / $limit);
			?>
			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="pagination-wrap">
						<ul>
							<?php
							if (!empty($total_pages)) : for ($i = 1; $i <= $total_pages; $i++) :
									if ($i == 1) : ?>
										<li class='active' id="<?php echo $i; ?>"><a href='shop.php?sort=<?php echo $_GET['sort']; ?>&page=<?php echo $i; ?>'><?php echo $i; ?></a></li>
									<?php else : ?>
										<li id="<?php echo $i; ?>"><a href='shop.php?sort=<?php echo $_GET['sort']; ?>&page=<?php echo $i; ?>'><?php echo $i; ?></a></li>
									<?php endif; ?>
							<?php endfor;
							endif; ?>
						</ul>
					</div>
				</div>
			</div>


			<script>
				jQuery(document).ready(function() {
					jQuery("#target-content").load("pagination.php?page=1");
					jQuery("#pagination li").live('click', function(e) {
						e.preventDefault();
						jQuery("#target-content").html('loading...');
						jQuery("#pagination li").removeClass('active');
						jQuery(this).addClass('active');
						var pageNum = this.id;
						jQuery("#target-content").load("pagination.php?page=" + pageNum);
					});
				});
			</script>

			<script>
				// Define the function that sends the variable to the server
				function sendVariable(variable, instock) {
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
							// console.log("Variable sent successfully: " + response);
						}
					});

				}
			</script>


		</div>
	</div>
	<!-- end products -->

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