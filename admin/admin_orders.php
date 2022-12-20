<?php
include('../config/essentials.php');
if (isAdmin() === false) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../pages/login.php');
};
include('config/functions.php');
include('config/edit_cart.php');

$orders = grabAllOrders();

?>

<?php include("templates/header.php"); ?>

<div class="profile-main-wrapper">
	<div class="profile-banner">
		<div class="profile-title">
			<p>Admin Home</p>
			<hr>
		</div>
		<div>
			<?php include('templates/profile_info.php'); ?>
			<a href="../admin/create_user.php">Create user</a>
		</div>
	</div>

	<div class="profile-content">
		<?php include("templates/admin-navbar.php"); ?>

		<!-- Displaying placed orders -->
		<div class="admin-user-details">
			<?php foreach ($orders as $order) { ?>
				<div>
					<p class="title">order id: <?php echo $order['id']; ?></p>
					<p>account id: <?php echo $order['account_id']; ?></p>
					<p>email: <?php echo $order['email']; ?></p>
					<p>name: <?php echo $order['fname'] . " " . $order['lname']; ?></p>
					<p>total paid: <?php echo $order['total_paid']; ?>.00</p>
					<a href="admin_home.php?cancel_order=<?php echo $order['id']; ?>" onclick="return confirm('Cancel this order?');">Cancel Order</a>
				</div>
			<?php } ?>
		</div>
	</div>
</div>

<?php include("templates/footer.php") ?>