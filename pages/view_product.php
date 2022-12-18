<?php
include('../config/essentials.php');
include('config/edit_cart.php');

if (isset($_GET['product'])) {
	$product_id = $_GET['product'];
	$product = grabProduct($product_id);
}
?>

<?php include("templates/header.php") ?>

<!-- notification message -->
<?php include('templates/notifications.php'); ?>

<!-- Displaying products -->
<div class="single-product-wrapper">
	<img class="" src="../product_images/<?php echo $product['img_name'] ?>" alt="">
	<div class="product-content">
		<p class="title"><?php echo $product['title']; ?></p>
		<p><?php echo $product['description'] ?></p>
		<p>Free shipping*</p>
		<p class="pricing">$<?php echo formatPrice($product['price']) ?></p>

		<!-- adds to cart, ajax style -->
		<form method="POST" onsubmit="return addCart(this);">
			<input type="hidden" name="quantity" value="1">
			<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
			<input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
			<input class="add-cart" type="submit" name="add_cart" value="Add to cart">
		</form>
	</div>
</div>

<?php include("templates/footer.php") ?>