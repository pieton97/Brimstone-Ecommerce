<?php
include('../config/essentials.php');
include('config/functions.php');

?>

<?php include("templates/header.php") ?>

<div class="header">
	<h2>Login</h2>
</div>
<form method="post" action="login.php">
	<!-- notification message -->
	<?php include('templates/notifications.php'); ?>

	<div class="input-group">
		<label>Username</label>
		<input type="text" name="username">
	</div>
	<div class="input-group">
		<label>Password</label>
		<input type="password" name="password">
	</div>
	<div class="input-group">
		<button type="submit" class="btn" name="login_btn">Login</button>
	</div>
	<p>
		Not yet a member? <a href="register.php">Sign up</a>
	</p>
</form>

<?php include("templates/footer.php") ?>

<?php
$users = grabAllUsers();
echo "<pre>" . print_r($users, true) . "</pre>";

?>
