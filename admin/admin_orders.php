<?php
include('../config/essentials.php');
if (isAdmin() === false) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../pages/login.php');
};

include('config/functions.php');
include('config/edit_cart.php');
include('config/edit_product.php');

$orders = grabAllOrders();

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

<!-- Displaying placed orders -->
<div class="user-list">
	<?php foreach ($orders as $order) { ?>
		<div class="user">
			<p>order id: <?php echo $order['id']; ?></p>
			<p>account id: <?php echo $order['account_id']; ?></p>
			<p>total paid: <?php echo $order['total_paid']; ?>.00</p>
			<a href="admin_home.php?cancel_order=<?php echo $order['id']; ?>" onclick="return confirm('Cancel this order?');">Cancel Order</a>
		</div>
	<?php } ?>
</div>


<?php include("templates/footer.php") ?>