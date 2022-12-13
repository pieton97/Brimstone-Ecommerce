<?php
include('../config/essentials.php');
include('config/edit_cart.php');

$products = grabAllProducts();
?>

<?php include("templates/header.php") ?>

<!-- notification message -->
<?php include('templates/notifications.php'); ?>

<img style="display: block; margin: 20px auto;" src="../images/dddd.jpg" width="100%" alt="">
<h1 style="text-align: center;">hello there this is the homepage</h1>

<!-- Displaying products -->
<div class="products-container">
	<?php foreach ($products as $product) { ?>
		<div class="product">
			<p><?php echo $product['title']; ?></p>
			<img class="product-img" src="../product_images/<?php echo $product['img_name'] ?>" alt="">
			<p>$<?php echo $product['price'] ?></p>
			<a href="view_product.php?product=<?php echo $product['id'] ?>">View product</a>

			<!-- adds to cart -->
			<form method="post" action="homepage.php">
				<input type="hidden" name="quantity" value="1">
				<input type="hidden" name="user_id" value="<?php echo $user_id ?>">
				<input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
				<input type="submit" name="add_cart" value="add-to-cart" class="btn brand z-depth-0">
			</form>

			<!-- adds to cart, ajax style -->
			<form method="POST" onsubmit="return test123(this);">
				<input type="hidden" name="quantity" value="1">
				<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
				<input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
				<input type="submit" name="add_cart" value="add-to-cart">
			</form>
		</div>
	<?php } ?>
</div>

<div>
	<h3 style="text-align: center;">Sign up for discounts:</h3>
	<form method="POST" onsubmit="return addMailingList(this)">
		<input type="text" name="name" placeholder="Enter your name..." required>
		<input type="email" name="email" placeholder="Enter your email..." required>
		<input type="submit" name="mailing_list" value="Sign up"></input>
		<p name='message' style="display: none;">Thank you for signing up with us!</p>
	</form>
</div>

<?php include("templates/footer.php") ?>