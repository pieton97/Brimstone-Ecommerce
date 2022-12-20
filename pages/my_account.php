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
			<hr>
		</div>
		<div class="content">
			<?php include('templates/profile_info.php'); ?>
		</div>
	</div>

	<div class="profile-content">
		<p class="title">Purchase history:</p>
		<hr>
		<?php if (count($orders) > 0) : ?>
			<div class="user-list">
				<?php foreach ($orders as $order) { ?>
					<div class="user">
						<p><?php echo $order['fname'] . ' ' . $order['lname']; ?></p>
						<p><?php echo $order['address']; ?></p>
						<p>total paid: $<?php echo formatPrice($order['total_paid']); ?></p>
						<a href="my_account.php?cancel_order=<?php echo $order['id']; ?>" onclick="return confirm('Cancel this order?');">Cancel Order</a>
					</div>
				<?php } ?>
			</div>
		<?php else : ?>
			<p>You have nothing in purchase history :(</p>
		<?php endif; ?>
	</div>
</div>


<?php include("templates/footer.php") ?>