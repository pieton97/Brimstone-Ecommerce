<?php
include('../config/essentials.php');
include('../config/edit_cart.php');

if (isLoggedIn()) {
	$_SESSION['shopping_cart'] = grabUserCart();
} else {
	if (!isset($_SESSION['shopping_cart'])) {
		$_SESSION['shopping_cart'] = array();
	}
}
$cartRows = count($_SESSION["shopping_cart"]);
$total_price = calcTotalPrice($_SESSION['shopping_cart']);
?>


<?php include("../templates/header.php") ?>

<?php
if ($cartRows > 0) :
?>
	<div class="cart-wrapper">
		<div class="cart-products-wrapper">
			<div class="cart-title">
				<p class="title">Shopping Cart</p>
				<p><a href="cart.php?delete_all_cart=1" onclick="return confirm('Remove all?');">Remove all</a></p>
			</div>
			<hr>
			<?php foreach ($_SESSION["shopping_cart"] as $product) { ?>
				<div class="cart-product">
					<img class="product-img" src="../product_images/<?php echo $product["img_name"]; ?>" />
					<div class="cart-product-details">
						<p class="title"><?php echo $product["title"]; ?></td>
						<p><?php echo "$" . formatPrice($product["price"]); ?></p>
						<form method='post' action='cart.php'>
							<?php if (isLoggedIn()) { ?>
								<input type="hidden" name="cart_id" value="<?php echo $product["cart_id"]; ?>" />
							<?php } else { ?>
								<input type="hidden" name="cart_id" value="<?php echo $product["product_id"]; ?>" />
							<?php } ?>

							<input type='hidden' name='update_cart' value="change" />
							<select name='quantity' onChange="this.form.submit()">
								<option <?php if ($product["quantity"] == 1) echo "selected"; ?> value="1">1</option>
								<option <?php if ($product["quantity"] == 2) echo "selected"; ?> value="2">2</option>
								<option <?php if ($product["quantity"] == 3) echo "selected"; ?> value="3">3</option>
								<option <?php if ($product["quantity"] == 4) echo "selected"; ?> value="4">4</option>
								<option <?php if ($product["quantity"] == 5) echo "selected"; ?> value="5">5</option>
								<?php if ($product["quantity"] > 5) : ?>
									<option <?php if ($product["quantity"] > 5) echo "selected"; ?> value="<?php echo $product["quantity"] ?>"><?php echo $product["quantity"] ?></option>
								<?php endif; ?>
							</select>
						</form>
						<p class="in-stock">In stock</p>
						<?php if (isLoggedIn()) { ?>
							<a href="cart.php?delete_from_cart=<?php echo $product["cart_id"]; ?>">Delete</a>
						<?php } else { ?>
							<a href="cart.php?delete_from_cart=<?php echo $product["product_id"]; ?>">Delete</a>
						<?php } ?>
					</div>
				</div>
			<?php } ?>
		</div>
		<hr>
		<div class="cart-pricing">
			<p class="price">Subtotal (<?php echo $cartRows; ?> items): <?php echo "$" . formatPrice($total_price); ?></p>
			<p>Estimated Tax (calculated during checkout)</p>
			<a class="checkout-btn" href="checkout.php?">Continue to Checkout</a>
		</div>
	</div>
<?php else : ?>
	<div class="empty-cart">
		<p class="title">Shopping Cart</p>
		<hr>
		<p>Your cart is empty!</p>
		<p>Try adding something to cart...</p>
	</div>
<?php endif; ?>

<?php include("../templates/footer.php") ?>