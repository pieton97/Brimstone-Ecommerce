<!DOCTYPE html>
<html>

<head>
	<title>Brimstone Collective</title>

	<link rel="stylesheet" type="text/css" href="../styles/style.css?v=<?php echo time(); ?>">

	<?php if (isAdmin()) : ?>
		<link rel="stylesheet" type="text/css" href="../styles/style2.css?v=<?php echo time(); ?>">
	<?php endif ?>

	<script src="../test.js" defer></script>
</head>

<body>

	<nav>
		<a href="../pages/homepage.php" class="">Brimstone Collective</a>
		<div>
			<p>other stuff</p>
		</div>
		<ul id="" class="">
			<li><a href="../pages/cart.php" class="">Cart</a></li>

			<?php if (isLoggedIn()) : ?>
				<li><a href="../pages/my_account.php">My Account</a></li>
			<?php else : ?>
				<li><a href="../pages/login.php">Login</a></li>
			<?php endif; ?>

			<?php if (isAdmin()) : ?>
				<li><a href="../admin/admin_home.php">Admin home</a></li>
			<?php endif ?>
		</ul>

	</nav>
