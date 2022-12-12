<!DOCTYPE html>
<html>

<head>
	<title>Milk Treats</title>
	<!-- <link rel="icon" href="../images/cookieslogo.png"> -->
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="stylesheet" type="text/css" href="../styles/style.css?v=<?php echo time(); ?>">

	<?php if (isAdmin()) : ?>
		<link rel="stylesheet" type="text/css" href="../styles/style2.css?v=<?php echo time(); ?>">
	<?php endif ?>

	<script src="../scripts/test.js" defer></script>
</head>

<body>

	<nav>
		<a href="../pages/homepage.php">Milk Treats</a>
		<ul>
			<li><a href="../pages/view_category.php?category=watch">Watches</a></li>
			<li><a href="../pages/view_category.php?category=cookies">Cookies</a></li>
			|
			<li><a href="../pages/view_category.php?subcategory=male">Men</a></li>
			<li><a href="../pages/view_category.php?subcategory=female">Women</a></li>
			<li><a href="../pages/view_category.php?subcategory=none">none</a></li>
		</ul>
		<ul>
			<li><a href="../pages/cart.php">Cart</a></li>

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