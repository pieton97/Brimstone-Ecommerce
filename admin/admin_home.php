<?php
include('../config/essentials.php');
if (isAdmin() === false) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../pages/login.php');
};

include('config/functions.php');
include('config/edit_cart.php');
include('config/edit_product.php');

// $products = grabAllProducts();
$products = array_slice(grabAllProducts(), 0, 5);
// $users = grabAllUsers();
$users = array_slice(grabAllUsers(), 0, 5);
// $orders = grabAllOrders();
$orders = array_slice(grabAllOrders(), 0, 5);
// $productss = json_decode($orders[0]['items_bought'], true);	//only have to decode 'items_bought'
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
			<p>$<?php echo formatPrice($product['price']) ?></p>
			<p><?php echo $product['category'] . "<br>" . $product['subcategory'] ?></p>

			<!-- update product info -->
			<a href="edit_product_form.php?update=<?php echo $product['id']; ?>">Update</a>
			<!-- delete product -->
			<a href="admin_home.php?delete=<?php echo $product['id'] . '&img_name=' . $product['img_name']; ?>" onclick="return confirm('Pernamently remove this product?');">Delete</a>
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

<!-- Displaying placed orders -->
<div class="user-list">
	<?php foreach ($orders as $order) { ?>
		<div class="user">
			<p>order id: <?php echo $order['id']; ?></p>
			<p>account id: <?php echo $order['account_id']; ?></p>
			<p>total paid: <?php echo formatPrice($order['total_paid']); ?></p>
			<a href="admin_home.php?cancel_order=<?php echo $order['id']; ?>" onclick="return confirm('Cancel this order?');">Cancel Order</a>
		</div>
	<?php } ?>
</div>

<?php include("templates/footer.php") ?>

<?php
// echo "<pre>" . print_r($orders, true) . "</pre>";
// echo "<pre>" . print_r($products, true) . "</pre>";
?>