<?php
include('../config/essentials.php');
include('../config/edit_cart.php');

if (!isLoggedIn() || count($_SESSION["shopping_cart"]) == 0) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
};
$curPurchase = array();
$total_price = calcTotalPrice($_SESSION['shopping_cart']);
$cartRows = count($_SESSION["shopping_cart"]);
$tax = formatPrice(0.0625 * $total_price);
$finalTotal = formatPrice($total_price + $tax);
?>

<?php include("../templates/header.php") ?>

<div class="checkout-wrapper">
	<div class="cart-title">
		<p>Checkout</p>
		<p><a href="cart.php?delete_all_cart=1" onclick="return confirm('Remove all?');">Remove all</a></td>
	</div>
	<hr>
	<form method="post">
		<div class="cart-products-wrapper">
			<?php foreach ($_SESSION["shopping_cart"] as $product) {
				$curItem = array();
				$curItem['title'] = $product['title'];
				$curItem['img_name'] = $product['img_name'];
				$curItem['quantity'] = $product['quantity'];
				array_push($curPurchase, $curItem);
			?>
				<div class="cart-product">
					<img class="product-img" src="../product_images/<?php echo $product["img_name"]; ?>" />
					<div class="cart-product-details">
						<p class="title"><?php echo $product["title"]; ?></p>
						<p class="in-stock">In stock</p>
						<p>Qty: <?php echo $product["quantity"] ?></p>
						<p><?php echo "$" . formatPrice($product["price"] * $product["quantity"]); ?></p>
					</div>
				</div>
			<?php } ?>
		</div>

		<hr>
		<div class="cart-pricing">
			<p>Subtotal (<?php echo $cartRows; ?> items): <?php echo "$" . formatPrice($total_price); ?></p>
			<p>Estimated Tax: $<?php echo $tax; ?></p>
			<p class="price">Total: $<?php echo $finalTotal; ?></p>

		</div>
		<hr>

		<div class="delivery-form">
			<div>
				<label for="email">Email address</label>
				<input type="email" id="email" name="email" value="<?php echo $email ?>" required>
			</div>
			<div>
				<label for="f-name">First Name</label>
				<input type="text" id="f-name" name="first_name" value="<?php echo $fName ?>" required>
			</div>
			<div>
				<label for="l-name">Last Name</label>
				<input type="text" id="l-name" name="last_name" value="<?php echo $lName ?>" required>
			</div>
			<div>
				<label for="address">Address (street, city, state)</label>
				<input type="text" id="address" name="address" value="<?php echo $address ?>" required>
			</div>
			<div>
				<label for="phone">Phone Number</label>
				<input type="text" id="phone" name="phone" value="<?php echo $phone ?>" required>
			</div>
			<div>
				<label>Select Payment Type</label>
				<select name='payment' required>
					<option value="">-Select Payment Type-</option>
					<option value="cash">Cash On Delivery</option>
					<option value="card">Debit/Credit Card</option>
				</select>
			</div>

			<input type="hidden" name="total_paid" value="<?php echo $finalTotal; ?>">
			<input type="hidden" name="purchased_items" value="<?php echo base64_encode(json_encode($curPurchase)); ?>">
			<button type="submit" name="checkout_cart">Place order</button>
		</div>
	</form>
</div>


<?php include("../templates/footer.php") ?>