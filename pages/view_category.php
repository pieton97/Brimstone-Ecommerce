<?php
include('../config/essentials.php');
include('config/edit_cart.php');

if (isset($_GET['category'])) {
	$category = $_GET['category'];
	$products = grabProductsByCategory($category);
}
if (isset($_GET['subcategory'])) {
	$subcategory = $_GET['subcategory'];
	$products = grabProductsBySubcategory($subcategory);
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
			<p>$<?php echo formatPrice($watch['price']) ?></p>
			<a href="view_product.php?product=<?php echo $watch['id'] ?>">View product</a>

			<!-- adds to cart -->
			<form method="post" action="homepage.php">
				<input type="hidden" name="quantity" value="1">
				<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
				<input type="hidden" name="product_id" value="<?php echo $watch['id']; ?>">
				<input type="submit" name="add_cart" value="add to cart" class="btn brand z-depth-0">
			</form>

			<!-- adds to cart, ajax style -->
			<form method="POST" onsubmit="return addCart(this);">
				<input type="hidden" name="quantity" value="1">
				<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
				<input type="hidden" name="product_id" value="<?php echo $watch['id']; ?>">
				<input type="submit" name="add_cart" value="add to cart">

				<!-- <input type="submit" value="Insert"> -->
			</form>
		</div>
	<?php } ?>

	<div>
		<h2>Our Policy to you</h2>
		<p>Find freshly made cookies at Mrs. Fields®, for less, with our selection of gourmet cookies and gift baskets on sale. Choose from a variety of favorite flavors and affordable arrangements, including cute cookie tins and sweet treat gift baskets, all at discount sale prices! With tons of timeless and tasty treats on sale like our classic chocolate chip cookies, mouth-watering white chocolate macadamia cookies, sugary snickerdoodle cookies, and many more, you’re sure to find all the flavors you and your loved ones enjoy most. You’ll also discover other delicious delights, like brownie bites and popcorn, as well as some seasonal favorites, all at reduced low pricing. Shop now - quantities are limited!</p>
	</div>
</div>

<?php include("templates/footer.php") ?>
