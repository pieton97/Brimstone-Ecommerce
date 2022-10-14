<?php
include('../config/essentials.php');
include('config/functions.php');

$watches = grabAllWatches();

?>

<?php include("templates/header.php") ?>

<!-- notification message -->
<?php include('templates/notifications.php'); ?>

<h1 style="text-align: center;">hello there this is the homepage</h1>

<!-- Displaying products -->
<div class="products-container">
	<?php foreach ($watches as $watch) { ?>
		<div class="product">
			<p><?php echo $watch['title']; ?></p>
			<img class="product-img" src="../product_images/<?php echo $watch['img_name'] ?>.png" alt="">
			<p>$<?php echo $watch['price'] ?></p>
			<p><?php echo $watch['description'] ?></p>
		</div>
	<?php } ?>
</div>

<?php include("templates/footer.php") ?>
