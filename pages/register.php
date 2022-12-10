<?php
include('../config/essentials.php');
include('config/edit_cart.php');
include('config/functions.php');

?>

<?php include("templates/header.php"); ?>

<div class="header">
	<h2>Register</h2>
</div>
<form method="post" action="register.php">
	<!-- notification message -->
	<?php include('templates/notifications.php'); ?>

	<div class="input-group">
		<label>Username</label>
		<input type="text" name="username" value="<?php echo $username; ?>">
	</div>
	<div class="input-group">
		<label>Email</label>
		<input type="email" name="email" value="<?php echo $email; ?>">
	</div>
	<div class="input-group">
		<label>Password</label>
		<input type="password" name="password_1">
	</div>
	<div class="input-group">
		<label>Confirm password</label>
		<input type="password" name="password_2">
	</div>
	<div class="input-group">
		<button type="submit" class="btn" name="register_btn">Register</button>
	</div>
	<p>
		Already a member? <a href="login.php">Sign in</a>
	</p>
</form>

<?php include("templates/footer.php") ?>

<?php
$users = grabAllUsers();
echo "<pre>" . print_r($users, true) . "</pre>";
?>
