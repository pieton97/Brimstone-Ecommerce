<?php
include('../config/essentials.php');
include('config/edit_cart.php');

if (!isLoggedIn() || !isset($_SESSION["shopping_cart"])) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
};
$curPurchase = array();
?>

<?php include("templates/header.php") ?>
<!-- notification message -->
<!-- <?php include('templates/notifications.php'); ?> -->
<div class="header">
	<h2>Checkout</h2>
</div>
<form method="post" action="">
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
			<?php foreach ($_SESSION["shopping_cart"] as $product) {
				$curItem = array();
				$curItem['title'] = $product['title'];
				$curItem['img_name'] = $product['img_name'];
				array_push($curPurchase, $curItem);
			?>
				<tr>
					<td>
						<img class="product-img" src="../product_images/<?php echo $product["img_name"]; ?>" />
					</td>
					<td><?php echo $product["title"]; ?></td>
					<td><?php echo $product["quantity"] ?></td>
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
				<td></td>
			</tr>
		</tbody>
	</table>


	<div class="input-group">
		<label for="name">Name</label>
		<input type="text" id="name" name="name" value="<?php echo $a ?>">
	</div>
	<div class="input-group">
		<label for="email">Email</label>
		<input type="email" id="email" name="email" value="">
	</div>
	<div class="input-group">
		<label for="address">Address (street, city, state)</label>
		<input type="text" id="address" name="address" value="">
	</div>
	<div class="input-group">
		<label for="phone">Phone Number</label>
		<input type="text" id="phone" name="phone" value="">
	</div>
	<div class="input-group">
		<label>Select Payment Type</label>
		<select name='payment'>
			<option>-Select Payment Type-</option>
			<option value="cash">Cash On Delivery</option>
			<option value="card">Debit/Credit Card</option>
		</select>
	</div>

	<input type="hidden" name="purchased_items" value="<?php echo base64_encode(json_encode($curPurchase)); ?>">
	<button type="submit" class="btn" name="checkout_cart">Place order</button>
</form>


<?php include("templates/footer.php") ?>

<?php 
	echo var_dump($curPurchase);
	echo "<pre>" . print_r($curPurchase, true) . "</pre>";

?>