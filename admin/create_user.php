<?php
include('../config/essentials.php');
include('config/functions.php');
?>

<?php include("templates/header.php"); ?>

<div class="form-wrapper">

	<div class="header">
		<h2>Admin - create user</h2>
	</div>

	<form class="product-form" method="post" action="create_user.php">
		<div>
			<label>Username</label>
			<input type="text" name="username" value="<?php echo $username; ?>">
		</div>
		<div>
			<label>Email</label>
			<input type="email" name="email" value="<?php echo $email; ?>">
		</div>
		<div>
			<label>User type</label>
			<select name="user_type" id="user_type">
				<option value=""></option>
				<option value="admin">Admin</option>
				<option value="user">User</option>
			</select>
		</div>
		<div>
			<label>Password</label>
			<input type="password" name="password_1">
		</div>
		<div>
			<label>Confirm password</label>
			<input type="password" name="password_2">
		</div>
		<div>
			<button type="submit" name="register_btn"> + Create user</button>
		</div>
		<p>
			<a href="admin_home.php">Cancel</a>
		</p>
	</form>
</div>

<?php include("templates/footer.php") ?>