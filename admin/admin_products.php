<?php
include('../config/essentials.php');
if (isAdmin() === false) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../pages/login.php');
};
include('config/functions.php');
include('config/edit_cart.php');

$products = grabAllProducts();
$count = count($products);
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
		<p>Current products: (<?php echo $count ?> count) <a href="add_product_form.php">Add product</a></p>
	</div>
	<?php foreach ($products as $product) { ?>
		<div class="product">
			<p><?php echo $product['title']; ?></p>
			<img class="product-img" src="../product_images/<?php echo $product['img_name'] ?>" alt="">
			<p>$<?php echo formatPrice($product['price']) ?></p>
			<p><?php echo $product['category'] . "<br>" . $product['subcategory'] ?></p>

			<!-- update product info -->
			<a href="edit_product_form.php?update=<?php echo $product['id']; ?>">Update</a>
			<!-- delete product -->
			<a href="admin_home.php?delete=<?php echo $product['id'] . '&img_name=' . $product['img_name']; ?>" onclick="return confirm('Pernamently remove this product?');">Delete</a>
		</div>
	<?php } ?>
</div>

<?php include("templates/footer.php") ?>