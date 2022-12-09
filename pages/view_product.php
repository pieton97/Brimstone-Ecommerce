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
<div class="products-container">
	<div>
		<p><?php echo $product['title']; ?></p>
		<img class="product-img" src="../product_images/<?php echo $product['img_name'] ?>" alt="">
		<p>$<?php echo $product['price'] ?></p>
		<p><?php echo $product['description'] ?></p>

		<!-- adds to cart -->
		<form method="post" action="view_product.php?product=<?php echo $product['id'] ?>">
			<input type="hidden" name="location" value="view_product.php?product=<?php echo $product['id'] ?>">
			<input type="hidden" name="quantity" value="1">
			<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
			<input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
			<input type="submit" name="add_cart" value="add to cart" class="btn brand z-depth-0">
		</form>
	</div>
</div>

<?php include("templates/footer.php") ?>
