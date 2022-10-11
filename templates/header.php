<?php 
echo isAdmin();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Brimstone Collective</title>
	<link rel="stylesheet" type="text/css" href="../styles/style.css">
	<link rel="stylesheet" type="text/css" href="../styles/style2.css">

	<?php if(isAdmin()) : ?>
	<?php endif ?>

	<style>
		body {
			padding: 30px;
		}
	</style>

	<script src="../test.js" defer></script>
</head>
<body>

<nav>
  <div>
    <a href="index.php" class="">Brimstone Collective</a>
    <ul id="" class="">
      <li><a href="cart.php" class="">Cart</a></li>
		<li><a href=""></a>My Account</li>
		<li><a href="login.php">Login</a></li>
		<li><a href="../pages/homepage.php">homepage</a></li>

		<?php if(isAdmin()) : ?>
			<li><a href="../admin/home.php">Admin home</a></li>
		<?php endif ?>
    </ul>
  </div>
</nav>
