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
	<?php include('templates/profile_info.php'); ?>
</div>
<div>
	<p>Account settings:</p>
</div>
<div>
	<p>Purchase history:</p>
</div>

<?php include("templates/footer.php") ?>
