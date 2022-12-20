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

		<!-- Displaying mailingList -->
		<div class="admin-user-details">
			<?php foreach ($mailingList as $user) { ?>
				<div>
					<p class="title">id: <?php echo $user['id']; ?></p>
					<p>name: <?php echo $user['name']; ?></p>
					<p>email: <?php echo $user['email']; ?></p>
					<p>joined date: <?php echo $user['created_at']; ?></p>
				</div>
			<?php } ?>
		</div>
	</div>
</div>

<?php include("templates/footer.php") ?>