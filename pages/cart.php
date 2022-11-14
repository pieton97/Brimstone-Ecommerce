<?php
include('../config/essentials.php');
include('config/edit_cart.php');

// if (!isLoggedIn()) 
// {
// 	$_SESSION['msg'] = "You must log in first";
// 	header('location: login.php');
// };

if (isLoggedIn()) {
	$_SESSION['shopping_cart'] = grabUserCart();
	$total_price = 0;
	foreach ($_SESSION["shopping_cart"] as $product) {
		$total_price += $product["price"] * $product["quantity"];
	};
	$_SESSION['total_price'] = $total_price;
} else {
	// $cart = $_SESSION['guest_cart'];
	// $_SESSION['shopping_cart'] = array();
}

// $_SESSION['shopping_cart'] = $cart;
// echo "<pre>" . print_r($_SESSION['shopping_cart'], true) . "</pre>";

?>


<?php include("templates/header.php") ?>

<div class="header">
	<h2>My Cart</h2>
</div>
<div class="content">
	<!-- notification message -->
	<?php include('templates/notifications.php'); ?>

	<!-- logged in user information -->
	<?php include('templates/profile_info.php'); ?>
</div>

<?php
if (isset($_SESSION["shopping_cart"])) :
?>
	<table class="table">
		<tbody>
			<tr>
				<td></td>
				<td>ITEM NAME</td>
				<td>QUANTITY</td>
				<td>UNIT PRICE</td>
				<td>TOTAL</td>
				<td><a href="cart.php?delete_all_cart=1" onclick="return confirm('Remove all?');">Remove all</a></td>
			</tr>
			<?php foreach ($_SESSION["shopping_cart"] as $product) { ?>
				<tr>
					<td>
						<img class="product-img" src="../product_images/<?php echo $product["img_name"]; ?>" />
					</td>
					<td><?php echo $product["title"]; ?></td>
					<td>
						<form method='post' action='cart.php'>
							<input type='hidden' name='cart_id' value="<?php echo $product["cart_id"]; ?>" />
							<input type='hidden' name='update_cart' value="change" />
							<select name='quantity' onChange="this.form.submit()">
								<option <?php if ($product["quantity"] == 1) echo "selected"; ?> value="1">1</option>
								<option <?php if ($product["quantity"] == 2) echo "selected"; ?> value="2">2</option>
								<option <?php if ($product["quantity"] == 3) echo "selected"; ?> value="3">3</option>
								<option <?php if ($product["quantity"] == 4) echo "selected"; ?> value="4">4</option>
								<option <?php if ($product["quantity"] == 5) echo "selected"; ?> value="5">5</option>
							</select>
						</form>
					</td>
					<td><?php echo "$" . $product["price"]; ?></td>
					<td><?php echo "$" . $product["price"] * $product["quantity"] . ".00"; ?></td>
					<td><a href="cart.php?delete_from_cart=<?php echo $product["cart_id"]; ?>">Delete</a></td>
				</tr>
			<?php } ?>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td>TOTAL:</td>
				<td>
					<strong><?php echo "$" . $_SESSION['total_price'] . ".00"; ?></strong>
				</td>
				<td><a href="checkout.php?">Checkout</a></td>
			</tr>
		</tbody>
	</table>
<?php
else : echo "<h3>Your cart is empty!</h3>";
endif;
?>

<?php include("templates/footer.php") ?>