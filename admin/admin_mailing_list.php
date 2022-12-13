<?php
include('../config/essentials.php');
if (isAdmin() === false) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../pages/login.php');
};
include('config/functions.php');

$mailingList = grabMailingList();

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

<!-- Displaying mailingList -->
<div class="user-list">
	<?php foreach ($mailingList as $user) { ?>
		<div class="user">
			<p>id: <?php echo $user['id']; ?></p>
			<p>name: <?php echo $user['name']; ?></p>
			<p>email: <?php echo $user['email']; ?></p>
			<p>joined date: <?php echo $user['created_at']; ?></p>
		</div>
	<?php } ?>
</div>


<?php include("templates/footer.php") ?>