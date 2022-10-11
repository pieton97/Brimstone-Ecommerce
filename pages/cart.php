<?php
include('../config/essentials.php');
include('config/functions.php');
if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
};
?>


<?php include("templates/header.php") ?>

	<div class="header">
		<h2>My Cart</h2>
	</div>
	<div class="content">
		<!-- notification message -->
		<?php include("templates/success.php"); ?>

		<!-- logged in user information -->
		<div class="profile_info">
			<img src="images/user_profile.png">

			<div>
				<?php if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong>

					<small>
						<i style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i>
						<br>
						<a href="index.php?logout='1'" style="color: red;">logout</a>
					</small>

				<?php endif ?>
			</div>
		</div>
	</div>
	<div>
		<p>User Cart:</p>
	</div>


	<!-- TODO: Clean up the page -->

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
					<td>ITEMS TOTAL</td>
				</tr>
				<?php foreach ($_SESSION["shopping_cart"] as $product) { ?>
					<tr>
						<td>
							<img src='<?php echo $product["image"]; ?>' width="50" height="40" />
						</td>
						<td><?php echo $product["name"]; ?><br />
							<form method='post' action=''>
								<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
								<input type='hidden' name='action' value="remove" />
								<button type='submit' class='remove'>Remove Item</button>
							</form>
						</td>
						<td>
							<form method='post' action=''>
								<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
								<input type='hidden' name='action' value="change" />
								<select name='quantity' class='quantity' onChange="this.form.submit()">
									<option <?php if ($product["quantity"] == 1) echo "selected"; ?> value="1">1</option>
									<option <?php if ($product["quantity"] == 2) echo "selected"; ?> value="2">2</option>
									<option <?php if ($product["quantity"] == 3) echo "selected"; ?> value="3">3</option>
									<option <?php if ($product["quantity"] == 4) echo "selected"; ?> value="4">4</option>
									<option <?php if ($product["quantity"] == 5) echo "selected"; ?> value="5">5</option>
								</select>
							</form>
						</td>
						<td><?php echo "$" . $product["price"]; ?></td>
						<td><?php echo "$" . $product["price"] * $product["quantity"]; ?></td>
					</tr>
				<?php
					$total_price += ($product["price"] * $product["quantity"]);
				}
				?>
				<tr>
					<td>
						<strong>TOTAL: <?php echo "$" . $total_price; ?></strong>
					</td>
				</tr>
			</tbody>
		</table>
	<?php
	  else :
		echo "<h3>Your cart is empty!</h3>";
	  endif;
	?>
<?php include("templates/footer.php") ?>
