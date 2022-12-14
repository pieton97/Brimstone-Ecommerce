<?php
include('../config/essentials.php');
include('config/edit_cart.php');
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
		<input id="login-name" type="text" name="username">
	</div>
	<div class="input-group">
		<label>Password</label>
		<input id="login-password" type="password" name="password">
	</div>
	<div class="input-group">
		<button type="submit" class="btn" name="login_btn">Login</button>
	</div>
	<p>
		Not yet a member? <a href="register.php">Sign up</a>
	</p>
</form>
<p>admin login click here:</p>
<button onclick="loginAdmin()">populate for admin</button>
<p>user login click here:</p>
<button onclick="loginUser()">populate for user</button>
<?php include("templates/footer.php") ?>

<?php
$users = grabAllUsers();
echo "<pre>" . print_r($users, true) . "</pre>";

?>