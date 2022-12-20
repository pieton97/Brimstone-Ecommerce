<?php
include('../config/essentials.php');
if (isAdmin() === false) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../pages/login.php');
};
include('config/functions.php');

$users = grabAllUsers();
?>


<?php
$query = "SELECT * FROM placed_orders";
$stmt = $pdo->prepare($query);
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

$productss = json_decode($orders[0]['items_bought'], true);	//only have to decode 'items_bought'

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
	</div>
</div>



<?php include("templates/footer.php") ?>