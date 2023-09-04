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
	$pId = $_GET['id'];
	$query = "SELECT * FROM blogs WHERE id=$pId";
	$result = mysqli_query($conn, $query);
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		$blog_name = $row["name"];
		$description = $row["description"];
		$blog_date = $row["date"];
	}
	?>

	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>Read the Details</p>
						<h1><?php echo $blog_name ?></h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- single article section -->
	<div class="mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="single-article-section">
						<div class="single-article-text">
							<img class="latest-news-bg" id="MediaImg" height="450" src="AdminPanel/dist/blogImageView.php?image_id=<?php echo $pId; ?> ">
							<p class="blog-meta">
								<span class="author"><i class="fas fa-user"></i> Admin</span>
								<span class="date"><i class="fas fa-calendar"></i><?php echo $blog_date ?></span>
							</p>
							<h2><?php echo $blog_name ?></h2>
							<p><?php echo $description ?></p>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="sidebar-section">
						<div class="recent-posts">
							<h4>Recent Posts</h4>
							<?php
							$query1 = "SELECT * FROM blogs ORDER BY date ASC";
							$result1 = mysqli_query($conn, $query1);
							while ($row = mysqli_fetch_array($result1)) {
							?>
								<ul>
									<li><a href="blogView.php?id=<?php echo $row[0]; ?>"><?php echo $row[1]; ?></a></li>
								</ul><?php  } ?>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
	<!-- end single article section -->

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