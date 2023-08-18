<div class="search-area">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<span class="close-btn"><i class="fas fa-window-close"></i></span>
				<div class="search-bar">
					<div class="search-bar-tablecell">
						<?PHP
						if (isset($_POST['searchButton'])) {
							$productName = $_POST['productName'];
							$href = "shop.php?sort=id&name=".$productName;
							echo ("<script>location.href='$href'</script>");
						}
						else{
							$href = "shop.php?sort=id";
						}
						?>
						<form action="" method="POST">
							<h3>Search For:</h3>
							<input type="text" name="productName" placeholder="Keywords">
							<button name="searchButton" type="submit">Search<i class="fas fa-search"></i></button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>