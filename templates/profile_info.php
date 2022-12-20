<div class="profile-info">
	<?php if (isAdmin() === true) : ?>
		<img src="../images/admin_profile.jpg">
	<?php else : ?>
		<img src="../images/user_profile.webp">
	<?php endif; ?>

	<div class="user-details">
		<?php if (isset($_SESSION['user'])) : ?>
			<p><?php echo $_SESSION['user']['username']; ?> <span style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</span></p>
			<p><?php echo $_SESSION['user']['email']; ?></p>
			<a href="../pages/cart.php?logout='1'" style="color: red;">logout</a>
		<?php endif ?>
	</div>
</div>