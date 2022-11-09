<?php
include('../config/essentials.php');
include('config/edit_cart.php');

if (!isLoggedIn() && isset($_SESSION["shopping_cart"])) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
};
$total_price = 0;
?>


<?php include("templates/header.php") ?>
<h2>Checkout</h2>
<!-- notification message -->
<!-- <?php include('templates/notifications.php'); ?> -->
<?php
if (isset($_SESSION["shopping_cart"])) :
	$total_price = 0;
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
			<?php
				$total_price += ($product["price"] * $product["quantity"]);
			}
			?>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td>TOTAL:</td>
				<td>
					<strong><?php echo "$" . $total_price . ".00"; ?></strong>
				</td>
				<td><a href="checkout.php?">Place Order</a></td>
			</tr>
		</tbody>
	</table>
<?php
else : echo "<h3>Your cart is empty!</h3>";
endif;
?>


<?php include("templates/footer.php") ?>