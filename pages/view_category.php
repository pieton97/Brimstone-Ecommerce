<?php
include('../config/essentials.php');
include('config/edit_cart.php');

if (isset($_GET['view_all'])) {
	$from = $_GET['view_all'];
	$products = grabAllProducts();
}
if (isset($_GET['category'])) {
	$from = $_GET['category'];
	$products = grabProductsByCategory($from);
}
if (isset($_GET['subcategory'])) {
	$from = $_GET['subcategory'];
	$products = grabProductsBySubcategory($from);
}
$count = count($products);
?>

<?php include("templates/header.php") ?>

<div class="products-container">
	<?php foreach ($products as $item) { ?>
		<div class="product">
			<a href="view_product.php?product=<?php echo $item['id'] ?>">
				<img class="product-img" src="../product_images/<?php echo $item['img_name'] ?>" alt="">
			</a>
			<div class="content">
				<a href="view_product.php?product=<?php echo $item['id'] ?>">
					<p class="title"><?php echo $item['title']; ?></p>
				</a>
				<p>Free shipping*</p>
				<p>$<?php echo formatPrice($item['price']) ?></p>
			</div>
			<form method="POST" onsubmit="return addCart(this);">
				<input type="hidden" name="quantity" value="1">
				<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
				<input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
				<input class="add-cart" type="submit" name="add_cart" value="Add to cart">
			</form>

		</div>
	<?php } ?>
</div>

<?php include("templates/footer.php") ?>