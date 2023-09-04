<!DOCTYPE html>
<html lang="en">

<style>
	.blogname {
		height: 50px;
	}
</style>

<?php
include('parts/head.php');

function selectFirstCharacters($inputString, $charCount)
{
	// If the string length is less than or equal to the limit, return the original string
	if (mb_strlen($inputString) <= $charCount) {
		return $inputString;
	}

	// Otherwise, slice the string to get the first $charCount characters
	$selectedCharacters = mb_substr($inputString, 0, $charCount);

	return $selectedCharacters;
}
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
						<p>Organic Information</p>
						<h1>News Article</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- latest news -->
	<div class="latest-news mt-150 mb-150">
		<div class="container">
			<div class="row">
				<?php
				$query1 = "SELECT * FROM blogs";
				$result1 = mysqli_query($conn, $query1);
				while ($row = mysqli_fetch_array($result1)) {
				?>
					<div class="col-lg-4 col-md-6">
						<div class="single-latest-news">
							<a href="blogView.php?id=<?php echo $row[0]; ?>"><img class="latest-news-bg" id="MediaImg" width="100%" height="180" src="AdminPanel/dist/blogImageView.php?image_id=<?php echo $row[0]; ?> "></a>
							<div class="news-text-box">
								<div class="blogname">
									<h3><a href="single-news1.php"><?php echo $row['name']; ?></a></h3>
								</div>
								<p class="blog-meta">
									<span class="author"><i class="fas fa-user"></i> Admin</span>
									<span class="date"><i class="fas fa-calendar"></i> <?php $originalDate = $row['date'];
																						$formattedDate = date('j F, Y', strtotime($originalDate));
																						echo $formattedDate; ?></span>
								</p>
								<p class="excerpt" maxlength="12"><?php
																	$inputString = $row['description'];
																	$charCount = 320; // Change this to the desired number of characters
																	$selectedCharacters = selectFirstCharacters($inputString, $charCount);
																	echo $selectedCharacters;
																	?>...</p>
								<a href="single-news1.php" class="read-more-btn">read more <i class="fas fa-angle-right"></i></a>
							</div>

						</div>
					</div>
				<?php  } ?>
			</div>
		</div>
	</div>
	<!-- end latest news -->

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
