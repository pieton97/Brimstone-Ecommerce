<?php
include('../config/essentials.php');
include('config/functions.php');
include('config/edit_cart.php');

if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}
$orders = grabAllOrdersByID($user_id);

?>

<?php include("templates/header.php") ?>

<div class="profile-main-wrapper">
	<div class="profile-banner">
		<div class="profile-title">
			<p>My Account</p>
		</div>
		<div class="content">
			<?php include("templates/notifications.php"); ?>
			<?php include('templates/profile_info.php'); ?>
		</div>
	</div>

	<div class="profile-content">
		<div>
			<p>Account settings:</p>
		</div>
		<p>Purchase history:</p>
		<div class="user-list">
			<?php foreach ($orders as $order) { ?>
				<div class="user">
					<p><?php echo $order['fname'] . ' ' . $order['lname']; ?></p>
					<p><?php echo $order['address']; ?></p>
					<p>total paid: <?php echo formatPrice($order['total_paid']); ?></p>
					<a href="my_account.php?cancel_order=<?php echo $order['id']; ?>" onclick="return confirm('Cancel this order?');">Cancel Order</a>
				</div>
			<?php } ?>
		</div>
	</div>
</div>


<?php include("templates/footer.php") ?>