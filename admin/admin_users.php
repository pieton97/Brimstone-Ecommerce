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

<div class="header">
	<h2>Admin Home</h2>
</div>
<div class="content">
	<?php include('templates/notifications.php'); ?>
	<?php include('templates/profile_info.php'); ?>
	<a href="create_user.php"> add user</a>
</div>

<?php include("templates/admin-navbar.php"); ?>

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



<?php include("templates/footer.php") ?>