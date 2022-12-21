<?php
include('../config/essentials.php');
include('../config/edit_cart.php');
include('../config/functions.php');

?>

<?php include("../templates/header.php") ?>

<div class="form-wrapper">
	<div class="header">
		<h2>Login</h2>
	</div>
	<div class="error" onclick="this.remove()"><?php echo display_error(); ?></div>

	<form class="product-form" method="post" action="login.php">
		<div>
			<label>Username</label>
			<input id="login-name" type="text" name="username">
		</div>
		<div>
			<label>Password</label>
			<input id="login-password" type="password" name="password">
		</div>
		<div>
			<button type="submit" name="login_btn">Login</button>
		</div>
		<p>Not yet a member? <a class="form-link" href="register.php">Sign up</a></p>
		<div>
			<p>Demo accounts:</p>
			<p class="form-link" onclick="loginAdmin()">Populate for admin</p>
			<p class="form-link" onclick="loginUser()">Populate for user</p>
		</div>
	</form>
</div>

<?php include("../templates/footer.php") ?>