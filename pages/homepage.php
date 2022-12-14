<?php
include('../config/essentials.php');
include('config/edit_cart.php');

$products = grabAllProducts();
?>

<?php include("templates/header.php") ?>

<!-- notification message -->
<?php include('templates/notifications.php'); ?>
<div>
	<img class="home-hero" src="../images/home-hero.jpg" alt="">
	<div>
		<p>title</p>
		<p>description...</p>
		<button>View All</button>
	</div>
</div>
<h1 style="text-align: center;">hello there this is the homepage</h1>

<!-- Displaying products -->
<div class="products-container">
	<?php foreach ($products as $product) { ?>
		<div class="product">
			<p><?php echo $product['title']; ?></p>
			<img class="product-img" src="../product_images/<?php echo $product['img_name'] ?>" alt="">
			<p>$<?php echo formatPrice($product['price']) ?></p>
			<a href="view_product.php?product=<?php echo $product['id'] ?>">View product</a>

			<!-- adds to cart -->
			<!-- <form method="post" action="homepage.php">
				<input type="hidden" name="quantity" value="1">
				<input type="hidden" name="user_id" value="<?php echo $user_id ?>">
				<input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
				<input type="submit" name="add_cart" value="add-to-cart" class="btn brand z-depth-0">
			</form> -->

			<!-- adds to cart, ajax style -->
			<form method="POST" onsubmit="return addCart(this);">
				<input type="hidden" name="quantity" value="1">
				<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
				<input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
				<input type="submit" name="add_cart" value="add-to-cart">
			</form>
		</div>
	<?php } ?>
</div>

<div>
	<div class="gif-container">
		<img class="gif-delivery" src="../images/delivery-box.webp" alt="">
	</div>
	<p>We Deliver To You</p>
	<p>The only thing better than opening a gift…is opening a gift that’s dessert. Send over-the-top holiday treats from NYC’s #1 bakery. Nationwide delivery in 1-2 days.</p>
	<button>Order Now</button>
</div>

<?php include("templates/footer.php") ?>