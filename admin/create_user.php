<?php
include('../config/essentials.php');
include('config/functions.php');
?>

<?php include("templates/header.php"); ?>

<div class="header">
	<h2>Admin - create user</h2>
</div>

<form method="post" action="create_user.php">
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
		<label>User type</label>
		<select name="user_type" id="user_type">
			<option value=""></option>
			<option value="admin">Admin</option>
			<option value="user">User</option>
		</select>
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
		<button type="submit" class="btn" name="register_btn"> + Create user</button>
	</div>
	<p>
		<a href="admin_home.php">Cancel</a>
	</p>
</form>

<hr>

<?php include("templates/footer.php") ?>

<?php
$users = grabAllUsers();
echo "<pre>" . print_r($users, true) . "</pre>";
?>
