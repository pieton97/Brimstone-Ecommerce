<?php
include('../config/essentials.php');
include('config/edit_cart.php');

$products = grabAllProducts();
?>

<?php include("templates/header.php") ?>

<!-- notification message -->
<?php include('templates/notifications.php'); ?>
<div class="home-wrapper">
	<img src="../images/sssss.webp" alt="">
	<div class="description-wrapper">
		<p class="title">SEND HOLIDAY MAGIC—STRAIGHT TO THEIR DOOR.</p>
		<p>This holiday season, send bigger, bolder, and more chocolate-y gifts with our new limited edition Chocolate Mint Chip Cake and Cake Truffles, epic Peppermint Bark Tie Dye Pie, and classic Milk Bar Cookie Tins.</p>
		<a class="action-btn" href="#">ORDER NOW</a>
	</div>
</div>

<hr>

<div class="categories-wrapper">
	<p class="title">IN THE SPOTLIGHT</p>
	<p></p>
	<div class="category-items-wrapper">
		<div class="category-item">
			<a href="../pages/view_category.php?subcategory=featured">
				<img src="../images/category/featured.jpg" alt="">
				<p>Featured</p>
			</a>
		</div>
		<div class="category-item">
			<a href="../pages/view_category.php?subcategory=gifts">
				<img src="../images/category/gifts.jpg" alt="">
				<p>Gifts</p>
			</a>
		</div>
		<div class="category-item">
			<a href="../pages/view_category.php?category=cookies">
				<img src="../images/category/cookie-tin.webp" alt="">
				<p>Cookies</p>
			</a>
		</div>
		<div class="category-item">
			<a href="../pages/view_category.php?category=cake">
				<img src="../images/category/birthday-cake.webp" alt="">
				<p>Cake</p>
			</a>
		</div>
		<div class="category-item">
			<a href="../pages/view_category.php?category=ice-cream">
				<img src="../images/category/ultimate-icecream.webp" alt="">
				<p>Ice Cream</p>
			</a>
		</div>
		<div class="category-item">
			<a href="../pages/view_category.php?category=mochi">
				<img src="../images/category/mochi.jpg" alt="">
				<p>Mochi</p>
			</a>
		</div>
	</div>
	<a class="action-btn" href="#">SEE ALL OPTIONS</a>
</div>

<div class="page-break">
	<div>
		<p>WHY WE'RE THE BEST</p>
		<P>explanation here...</P>
	</div>
</div>

<div class="gift-container">
	<div class="gift-descr">
		<p>HAPPINESS DELIVERED</p>
		<p>The only thing better than opening a gift…is opening a gift that’s dessert. Make somebody's day bright by sending our best-selling, over-the-top treats today. Nationwide delivery in 1-2 days.</p>
		<button>ORDER NOW</button>
	</div>
	<div class="img-wrapper">
		<img class="gift-delivery" src="../images/delivery-box.webp" alt="">
	</div>
</div>

<?php include("templates/footer.php") ?>