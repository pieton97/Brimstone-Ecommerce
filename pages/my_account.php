<?php
include('../config/essentials.php');
include('config/functions.php');

if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}

?>

<?php include("templates/header.php") ?>

<div class="header">
	<h2>My Account</h2>
</div>
<div class="content">
	<!-- notification message -->
	<?php include("templates/notifications.php"); ?>

	<!-- logged in user information -->
	<div class="profile_info">
		<img src="../images/user_profile.webp">

		<div>
			<?php if (isset($_SESSION['user'])) : ?>
				<strong><?php echo $_SESSION['user']['username']; ?></strong>

				<small>
					<i style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i>
					<br>
					<a href="my_account.php?logout='1'" style="color: red;">logout</a>
				</small>

			<?php endif ?>
		</div>
	</div>
</div>
<div>
	<p>Account settings:</p>
</div>
<div>
	<p>Purchase history:</p>
</div>

<?php include("templates/footer.php") ?>
