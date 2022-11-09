<?php
include('../config/essentials.php');
include('config/edit_cart.php');

if (isset($_GET['category'])) {
	$category = $_GET['category'];
	$products = grabProductsByCategory($category);
}
if (isset($_GET['gender'])) {
	$gender = $_GET['gender'];
	$products = grabProductsByGender($gender);
}
?>

<?php include("templates/header.php") ?>

<!-- notification message -->
<?php include('templates/notifications.php'); ?>

<!-- Displaying products -->
<div class="products-container">
	<?php foreach ($products as $watch) { ?>
		<div class="product">
			<p><?php echo $watch['title']; ?></p>
			<img class="product-img" src="../product_images/<?php echo $watch['img_name'] ?>" alt="">
			<p>$<?php echo $watch['price'] ?></p>
			<a href="view_product.php?product=<?php echo $watch['id'] ?>">View product</a>

			<!-- adds to cart -->
			<form method="post" action="homepage.php">
				<input type="hidden" name="quantity" value="1">
				<input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['id']; ?>">
				<input type="hidden" name="product_id" value="<?php echo $watch['id']; ?>">
				<input type="submit" name="add_cart" value="add to cart" class="btn brand z-depth-0">
			</form>

			<!-- adds to cart, ajax style -->
			<form method="POST" onsubmit="return test123(this);">
				<input type="hidden" name="quantity" value="1">
				<input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['id']; ?>">
				<input type="hidden" name="product_id" value="<?php echo $watch['id']; ?>">
				<input type="submit" name="add_cart" value="add to cart">

				<!-- <input type="submit" value="Insert"> -->
			</form>
		</div>
	<?php } ?>
</div>

<?php include("templates/footer.php") ?>
