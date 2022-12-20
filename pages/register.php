<?php
include('../config/essentials.php');
include('config/edit_cart.php');
include('config/functions.php');

?>

<?php include("templates/header.php"); ?>

<div class="form-wrapper">
	<div class="header">
		<h2>Register</h2>
	</div>
	<div class="error" onclick="this.remove()"><?php echo display_error(); ?></div>

	<form class="product-form" method="post" action="register.php">
		<div>
			<label>Username</label>
			<input type="text" name="username" value="<?php echo $username; ?>">
		</div>
		<div>
			<label>Email</label>
			<input type="email" name="email" value="<?php echo $email; ?>">
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
			<button type="submit" name="register_btn">Register</button>
		</div>
		<p>
			Already a member? <a href="login.php">Sign in</a>
		</p>
	</form>
</div>

<?php include("templates/footer.php") ?>