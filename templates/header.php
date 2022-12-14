<!DOCTYPE html>
<html>

<head>
	<title>Milk Treats</title>
	<link rel="shortcut icon" type="image/jpg" href="../images/cookieslogo.png" />

	<!-- <link rel="icon" href="../images/cookieslogo.png"> -->
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" type="text/css" href="../styles/style.css?v=<?php echo time(); ?>">

	<?php if (isAdmin()) : ?>
		<link rel="stylesheet" type="text/css" href="../styles/style2.css?v=<?php echo time(); ?>">
	<?php endif ?>

	<script src="../scripts/test.js" defer></script>
	<script src="../scripts/populateData.js" defer></script>
</head>

<body>
	<div class="heading-container">
		<p class="sale-banner">ENJOY FREE STANDARD SHIPPING WHEN YOU ORDER NOW DURING THIS HOLIDAY!</p>

		<nav>
			<a href="../pages/homepage.php">Milk Treats</a>
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