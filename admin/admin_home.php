<?php
include('../config/essentials.php');
include('config/functions.php');
include('config/edit_cart.php');

if (isAdmin() === false) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../pages/login.php');
}

$watches = grabAllWatches();
$cart = grabUserCart();
$users = grabAllUsers();
?>


<?php include("templates/header.php"); ?>

<div class="header">
	<h2>Admin Home</h2>
</div>
<div class="content">
	<!-- notification message -->
	<?php include('templates/notifications.php'); ?>

	<!-- logged in user information -->
	<?php include('templates/profile_info.php'); ?>
</div>

<!-- Editing products -->
<div class="products-container">
	<div class="edit-products">
		<p>Current products:</p>
		<a href="add_product_form.php">add product</a>
	</div>
	<?php foreach ($watches as $watch) { ?>
		<div class="product">
			<p><?php echo $watch['title']; ?></p>
			<img class="product-img" src="../product_images/<?php echo $watch['img_name'] ?>.png" alt="">
			<p>$<?php echo $watch['price'] ?></p>

			<!-- update product info -->
			<a href="edit_product_form.php?update=<?php echo $watch['id']; ?>">Update</a>

			<!-- delete product -->
			<a href="add_product_form.php?delete=<?php echo $watch['id']; ?>">Delete</a>

			<!-- adds to cart -->
			<form method="post" action="admin_home.php">
				<input type="hidden" name="location" value="admin_home.php">
				<input type="number" min="1" max="10" name="quantity" value="1">
				<input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['id']; ?>">
				<input type="hidden" name="product_id" value="<?php echo $watch['id']; ?>">
				<input type="submit" name="add_cart" value="add to cart" class="btn brand z-depth-0">
			</form>
		</div>
	<?php } ?>
</div>

<!-- Displaying all users -->
<div class="user-list">
	<?php foreach ($users as $user) { ?>
		<div class="user">
			<p>ID: <?php echo $user['id']; ?></p>
			<p><?php echo $user['username']; ?></p>
			<p><?php echo $user['email'] ?></p>
			<p><?php echo $user['user_type'] ?></p>
			<p><?php echo $user['created_at'] ?></p>
			<!-- delete user -->
			<a href="admin_home.php?delete_user=<?php echo $user['id']; ?>" onclick="return confirm('Pernamently remove this user?');">Delete</a>
		</div>
	<?php } ?>
</div>

<?php include("templates/footer.php") ?>

<?php
// echo "<pre>" . print_r($cart, true) . "</pre>";
echo "<pre>" . print_r($watches, true) . "</pre>";
?>