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
$count = count($products);
$products = array_slice($products, 0, 5);
$users = array_slice(grabAllUsers(), 0, 5);
$orders = array_slice(grabAllOrders(), 0, 5);
// $productss = json_decode($orders[0]['items_bought'], true);	//only have to decode 'items_bought'
?>


<?php include("templates/header.php"); ?>

<div class="profile-main-wrapper">
	<div class="profile-banner">
		<div class="profile-title">
			<p>Admin Home</p>
		</div>
		<div>
			<?php include('templates/notifications.php'); ?>
			<?php include('templates/profile_info.php'); ?>
		</div>
	</div>

	<div class="profile-content">
		<?php include("templates/admin-navbar.php"); ?>
		<!-- <a href="../admin/create_user.php">Create user</a> -->

		<!-- Editing products -->
		<div class="admin-product-wrapper">
			<div class="admin-product-header">
				<p>Current products: (<?php echo $count ?> count) <a href="add_product_form.php">Add product</a>, <a href="../admin/admin_products.php">View all</a></p>
			</div>
			<div class="admin-products">
				<?php foreach ($products as $product) { ?>
					<div class="admin-product">
						<img src="../product_images/<?php echo $product['img_name'] ?>" alt="">
						<div class="admin-product-details">
							<p class="title"><?php echo $product['title']; ?></p>
							<p>$<?php echo formatPrice($product['price']) ?></p>
							<p><?php echo $product['category'] ?></p>
							<p><?php echo $product['subcategory'] ?></p>

							<!-- update product info -->
							<a href="edit_product_form.php?update=<?php echo $product['id']; ?>">Update</a>
							<!-- delete product -->
							<a href="admin_home.php?delete=<?php echo $product['id'] . '&img_name=' . $product['img_name']; ?>" onclick="return confirm('Pernamently remove this product?');">Delete</a>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>

		<hr>
		<!-- Displaying all users -->
		<div class="admin-user-details">
			<?php foreach ($users as $user) { ?>
				<div>
					<p class="title">ID: <?php echo $user['id']; ?></p>
					<p><?php echo $user['username']; ?></p>
					<p><?php echo $user['email'] ?></p>
					<p><?php echo $user['user_type'] ?></p>
					<p><?php echo $user['created_at'] ?></p>
					<!-- delete user -->
					<a href="admin_home.php?delete_user=<?php echo $user['id']; ?>" onclick="return confirm('Pernamently remove this user?');">Delete</a>
				</div>
			<?php } ?>
		</div>

		<hr>
		<!-- Displaying placed orders -->
		<div class="admin-user-details">
			<?php foreach ($orders as $order) { ?>
				<div>
					<p class="title">order id: <?php echo $order['id']; ?></p>
					<p>account id: <?php echo $order['account_id']; ?></p>
					<p>email: <?php echo $order['email']; ?></p>
					<p>name: <?php echo $order['fname'] . " " . $order['lname']; ?></p>
					<p>total paid: <?php echo formatPrice($order['total_paid']); ?></p>
					<a href="admin_home.php?cancel_order=<?php echo $order['id']; ?>" onclick="return confirm('Cancel this order?');">Cancel Order</a>
				</div>
			<?php } ?>
		</div>
	</div>
</div>

<?php include("templates/footer.php") ?>