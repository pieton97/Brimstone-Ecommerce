<?php
include('../config/essentials.php');
if (isAdmin() === false) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../pages/login.php');
};

include('config/functions.php');
include('config/edit_cart.php');
include('config/edit_product.php');

$products = grabAllProducts();
// $products = array_slice($products, 0, 5);
?>

<?php include("templates/header.php"); ?>

<div class="header">
	<h2>Admin Home</h2>
</div>
<div class="content">
	<?php include('templates/notifications.php'); ?>
	<?php include('templates/profile_info.php'); ?>
	<a href="create_user.php"> add user</a>
</div>

<?php include("templates/admin-navbar.php"); ?>

<!-- Editing products -->
<div class="products-container">
	<div class="edit-products">
		<p>Current products:</p>
		<a href="add_product_form.php">Add product</a>
	</div>
	<?php foreach ($products as $product) { ?>
		<div class="product">
			<p><?php echo $product['title']; ?></p>
			<img class="product-img" src="../product_images/<?php echo $product['img_name'] ?>" alt="">
			<p>$<?php echo $product['price'] ?></p>
			<p><?php echo $product['category'] . "<br>" . $product['subcategory'] ?></p>

			<!-- update product info -->
			<a href="edit_product_form.php?update=<?php echo $product['id']; ?>">Update</a>

			<!-- delete product -->
			<a href="admin_home.php?delete=<?php echo $product['id'] . '&img_name=' . $product['img_name']; ?>" onclick="return confirm('Pernamently remove this product?');">Delete</a>

			<!-- adds to cart -->
			<form method="post" action="admin_home.php">
				<input type="hidden" name="location" value="admin_home.php">
				<input type="number" min="1" max="10" name="quantity" value="1">
				<input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['id']; ?>">
				<input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
				<input type="submit" name="add_cart" value="add to cart" class="btn brand z-depth-0">
			</form>
		</div>
	<?php } ?>
</div>

<?php include("templates/footer.php") ?>