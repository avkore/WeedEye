<!DOCTYPE html>
<html lang="en">

<?php
include('parts/head.php');
include('parts/header.php');
@include 'config.php';
?>

<style>
	input::-webkit-outer-spin-button,
	input::-webkit-inner-spin-button {
		-webkit-appearance: none;
		margin: 0;
	}
</style>


<body>

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
						<h1>Cart</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- cart -->
	<div class="cart-section mt-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-12">
					<div class="cart-table-wrap">
						<table class="cart-table">
							<thead class="cart-table-head">
								<tr class="table-head-row">
									<th class="product-remove"></th>
									<th class="product-image">Product Image</th>
									<th class="product-name">Name</th>
									<th class="product-price">Price</th>
									<th class="product-quantity">Quantity</th>
									<th class="product-total">Total</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if (isset($_SESSION['id']))
									$user_id = $_SESSION['id'];
								elseif (!isset($_SESSION['id']) && isset($_COOKIE['id']))
									$user_id = $_COOKIE['id'];

								$sql = "SELECT products.name, products.id, products.price, card_items.quantity, card_items.id, products.instock FROM products INNER JOIN card_items ON products.id = card_items.product_id WHERE submited = 0 AND user_id=$user_id ";
								$result = mysqli_query($conn, $sql);
								$subtotal = 0;
								$productString = '';
								while ($row = mysqli_fetch_array($result)) {
								?>
									<tr class="table-body-row">
										<td class="product-remove"><i class="far fa-window-close" onclick="DeleteProduct(<?php echo $row[4] ?>);"></i></td>
										<td class="product-image"><img width="100" height="75" src="AdminPanel/dist/productImageView.php?image_id=<?php echo $row[1]; ?>" alt=""></td>
										<td class="product-name"><?php echo $row[0] ?></td>
										<td class="product-price"><?php echo $row[2] ?></td>
										<td class="product-quantity"><input type="number" class="myInput" max="<?php echo $row[5]; ?>" onkeyup="myFunction(<?php echo $row[4]; ?>, <?php echo $row[5]; ?>)" min="1" value="<?php echo $row[3] ?>"></td>
										<td class="product-total"><?php echo $row[3] * $row[2]; ?></td>
									</tr>
								<?php
									$subtotal += $row[2] * $row[3];
									$productString =  ', ' . $row[3] . 'x ' . $row[0] . ' ' . $productString;
								}

								$productString = substr($productString, 1);
								?>
							</tbody>
						</table>
					</div>
				</div>

				<div class="col-lg-4">
					<div class="total-section">
						<table class="total-table">
							<thead class="total-table-head">
								<tr class="table-total-row">
									<th>Total</th>
									<th>Price</th>
								</tr>
							</thead>
							<tbody>
								<tr class="total-data">
									<td><strong>Subtotal: </strong></td>
									<td id="subtotal">₾<?php echo $subtotal; ?></td>
								</tr>
								<tr class="total-data">
									<td><strong>Total: </strong></td>
									<td id="output">₾<?php echo $subtotal; ?> + Shipping</td>
								</tr>
							</tbody>
						</table>

						<div class="cart-buttons text-center">
							<button class="boxed-btn black" id="buttonToScroll">Check Out</button>
						</div>
					</div>
				</div>

				<div class="col-lg-8 mt-150" id="ToBeScrolled">
					<div class="checkout-accordion-wrap">
						<div class="accordion" id="accordionExample">
							<div class="card single-accordion">
								<div class="card-header" id="headingOne">
									<h5 class="mb-0">
										<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
											Shipping and Payment
										</button>
									</h5>
								</div>

								<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
									<div class="card-body">
										<div class="billing-address-form">
											<form action="" method="POST">
												<div class="container">
													<div class="row">
														<div class="col-md-12 order-md-1">
															<h4 class="mb-3">Shipping Address</h4>
															<div class="row">
																<div class="col-md-6 mb-3">
																	<input type="text" class="form-control" name="firstName" placeholder="First name" value="" required="">
																</div>
																<div class="col-md-6 mb-3">
																	<input type="text" class="form-control" name="lastName" placeholder="Last name" value="" required="">
																	<input type="hidden" name="totalprice" value="<?php echo $subtotal; ?>">
																	<input type="hidden" name="productsList" value="<?php echo $productString; ?>">
																</div>
															</div>
															<div class="row">
																<div class="col-md-6 mb-3">
																	<input type="email" class="form-control" name="email" placeholder="you@example.com">
																</div>
																<div class="col-md-6 mb-3">
																	<input type="telephone" class="form-control" name="telephone" placeholder="(+995)551-123-456" value="" required="">
																</div>
															</div>
															<div class="mb-3">
																<input type="text" class="form-control" name="address" placeholder="Address" required="">
															</div>
															<div class="row">
																<div class="col-md-5 mb-3">
																	<input type="text" class="form-control" name="country" placeholder="Country" required="">
																</div>

																<div class="col-md-4 mb-3">
																	<input type="text" class="form-control" name="city" placeholder="City" required="">
																</div>
																<div class="col-md-3 mb-3">
																	<input type="text" class="form-control" name="zip" placeholder="Zip Code" required="">
																	<div class="invalid-feedback"> Zip code required. </div>
																</div>
															</div>
															<hr class="mb-4">
															<h4 class="mb-3">Shipping</h4>
															<div class="d-block my-3">
																<div class="custom-control custom-radio">
																	<input id="standard" name="shipping" type="radio" class="custom-control-input" checked="" required="" value="Standard - 0₾">
																	<label class="custom-control-label" for="standard">Standard Shipping (1-3 Day) - <strong>Free</strong></label>
																</div>
																<div class="custom-control custom-radio">
																	<input id="payed" name="shipping" type="radio" class="custom-control-input" required="" value="Same Day - 6₾">
																	<label class="custom-control-label" for="payed">Ship Same Day- <strong>+6 GEL</strong></label>
																</div>
																<div class="custom-control custom-radio">
																	<input id="region" name="shipping" type="radio" class="custom-control-input" required="" value="Standard Region - 8₾">
																	<label class="custom-control-label" for="region">Standard Shipping To Regions (1-6 Day) - <strong>+8 GEL</strong></label>
																</div>
															</div>
															<hr class="mb-4">
															<h4 class="mb-3">Payment</h4>
															<div class="d-block my-3">
																<div class="custom-control custom-radio">
																	<input id="bank" name="payment" type="radio" class="custom-control-input" checked="" required="" value="Bank">
																	<label class="custom-control-label" for="bank">Bank Deposit</label>
																</div>
																<div class="custom-control custom-radio">
																	<input id="cash" name="payment" type="radio" class="custom-control-input" required="" value="Cash">
																	<label class="custom-control-label" for="cash">Pay By Cash (COD)</label>
																</div>
															</div>
														</div>
													</div>
												</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 mt-150">
					<div class="container">
						<div class="row">
							<div class="col-md-12 col-lg-12 offset-md-2 offset-lg-2 text-center mt-150">
								<h1>Warning!</h1>
								<p>Please Make Sure That All The Details are Correct. We Dont Take Any Responsibilities For Orders Made With Incorrect Information.
									If You Have Already Submited Order With Incorrect Details, Please Write To <a href="contact.php">Support</a>
								</p>
								<div class="cart-buttons">
									<button type="submit" name="submitOrder" class="boxed-btn black" id="buttonToScroll">Submit Order</button>
								</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
		if (isset($_POST['submitOrder'])) {
			if (isset($_SESSION['id'])) {
				// User is logged in
				$user_id = $_SESSION['id'];
			} elseif (isset($_COOKIE['id'])) {
				// User has the 'id' cookie set
				$user_id = $_COOKIE['id'];
			} else {
				exit('User not logged in or cookie not set.');
			}

			$firstName = $_POST['firstName'];
			$lastName = $_POST['lastName'];
			$email = $_POST['email'];
			$phone = $_POST['telephone'];
			$productsList = $_POST['productsList'];
			$totalprice = $_POST['totalprice'];
			$shipping = $_POST['shipping'];
			$payment = $_POST['payment'];
			$country = $_POST['country'];
			$city = $_POST['city'];
			$address = $_POST['address'];
			$zipCode = $_POST['zip'];
			$address = $_POST['address'];


			if ($subtotal > 0) {
				$insert = "INSERT INTO orders(user_id, Firstname, LastName, email, phone, products, price, Shipping, Payment, Country,  City, Address, ZipCode) VALUES('$user_id', '$firstName', '$lastName', '$email', '$phone', '$productsList', '$totalprice', '$shipping', '$payment', '$country', '$city', '$address', '$zipCode')";
				mysqli_query($conn, $insert);

				$update = "UPDATE card_items SET submited=1 WHERE user_id=$user_id AND submited=0";
				mysqli_query($conn, $update);

				$update1 = "UPDATE users SET address='$address', phone='$phone', region='$city', zipCode='$zipCode' WHERE id=$user_id";
				mysqli_query($conn, $update1);

				// Update product quantities
				$productsListArray = explode(', ', $productsList); // Convert the products list to an array
				foreach ($productsListArray as $productInfo) {
					
					$productInfoArray = explode('x ', $productInfo); // Split product info into quantity and name
					$purchasedQuantity = intval($productInfoArray[0]); // Convert quantity to integer
					$productName = mysqli_real_escape_string($conn, $productInfoArray[1]); // Escape product name
					
					
					// Fetch the current quantity from the products table
					$getQuantityQuery = "SELECT instock FROM products WHERE name = '$productName'";
					$result = mysqli_query($conn, $getQuantityQuery);
					$row = mysqli_fetch_assoc($result);
					$currentQuantity = $row['instock'];
			
					// Calculate new quantity after purchase
					$newQuantity = $currentQuantity - $purchasedQuantity;
			
					// Update the product quantity in the products table
					$updateQuantityQuery = "UPDATE products SET instock = $newQuantity WHERE name = '$productName'";
					mysqli_query($conn, $updateQuantityQuery);
				}

				echo '<script>window.alert("You have Successfully Submited Order!")</script>';
				echo ("<script>location.href='shop.php?sort=id'</script>");
			} else {
				echo '<script>window.alert("Please Choose Product First!")</script>';
			}
		}
		?>
	</div>
	</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<script>
		$(document).ready(function() {
			$('input[type="radio"]').click(function() {
				var shipping = $(this).val();
				var subtotal = parseFloat($('#subtotal').text().replace('₾', ''));
				$.ajax({
					url: "changeShippingPrice.php",
					method: "POST",
					data: {
						shipping: shipping,
						subtotal: subtotal
					},
					success: function(data) {
						$('#output').html(data);
					}
				});
			});
		});
	</script>



	<script>
		function myFunction(value, instock) {

			$(document).ready(function() {
				// Bind the keyup event to the input field
				$('input[type="number"]').on('keyup', function() {
					// Get the value of the input field
					var quantity = $(this).val();
					// Send an AJAX request to update the quantity
					$.ajax({
						type: "POST",
						url: "deleteP.php",
						data: {
							quantity: quantity,
							instock: instock,
							value: value
						},
						success: function(response) {
							location.reload();
							//console.log("Variable sent successfully: " + response);
						}
					});
				});
			});
		}
	</script>

	<script>
		// Define the function that sends the variable to the server
		function DeleteProduct(variable) {
			// Send the variable to the server using jQuery's AJAX function

			$.ajax({
				type: "POST",
				url: "deleteP.php",
				data: {
					product: 'product',
					variable: variable
				},
				success: function(response) {
					window.location.reload();
					//console.log("Variable sent successfully: " + response);
				}
			});
		}
	</script>

	<script>
		const button = document.getElementById('buttonToScroll');
		const divToScroll = document.getElementById('ToBeScrolled');

		button.addEventListener('click', () => {
			const yOffset = -100; // adjust this value to scroll to the desired position
			const y = divToScroll.getBoundingClientRect().top + window.pageYOffset + yOffset;
			window.scrollTo({
				top: y,
				behavior: 'smooth'
			});
		});
	</script>


	<!-- end cart -->

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