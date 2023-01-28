<!DOCTYPE html>
<html>

<head>
	<title>Milk Treats</title>
	<link rel="shortcut icon" type="image/jpg" href="../images/cookielogo.jpg" />

	<!-- <link rel="icon" href="../images/cookieslogo.png"> -->
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" type="text/css" href="../styles/navbar.css?<?php echo time(); ?>">
	<link rel="stylesheet" type="text/css" href="../styles/homepage.css?<?php echo time(); ?>">
	<link rel="stylesheet" type="text/css" href="../styles/footer.css?<?php echo time(); ?>">
	<link rel="stylesheet" type="text/css" href="../styles/products.css?<?php echo time(); ?>">
	<link rel="stylesheet" type="text/css" href="../styles/users.css?<?php echo time(); ?>">
	<link rel="stylesheet" type="text/css" href="../styles/general.css?<?php echo time(); ?>">

	<script src="../scripts/test.js" defer></script>
	<script src="../scripts/populateData.js" defer></script>
</head>

<body>
	<p class="sale-banner">FREE SHIPPING FOR ORDERS PLACED WITHIN THE U.S. ALWAYS FREE RETURNS</p>
	<div class="heading-container">
		<nav>
			<div class="nav-logo-container">
				<a href="../pages/homepage.php"><img src="../images/cookie-logo.png" alt=""></a>
				<a href="../pages/homepage.php">
					<p>Milk Treats</p>
				</a>
			</div>
			<ul>
				<li><a href="../pages/view_category.php?category=cookies">Cookies</a></li>
				<li><a href="../pages/view_category.php?category=cake">Cake</a></li>
				<li><a href="../pages/view_category.php?category=ice-cream">Ice Cream</a></li>
				<li><a href="../pages/view_category.php?category=mochi">Mochi</a></li>
				<!-- <li><a href="../pages/view_category.php?category=cookbooks">Cookbooks</a></li> -->
				|
				<li><a href="../pages/view_category.php?subcategory=gifts">Gifts</a></li>
				<li><a href="../pages/view_category.php?subcategory=featured">Featured</a></li>
				<!-- <li><a href="../pages/view_category.php?subcategory=others">others</a></li> -->
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
	</div>

	<main>