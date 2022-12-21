<?php
include('../config/essentials.php');
include('../config/edit_cart.php');

$products = grabAllProducts();
?>

<?php include("../templates/header.php") ?>

<div class="home-wrapper">
	<img src="../images/home-hero.jpg" alt="">
	<div class="description-wrapper">
		<p class="title">SEND HOLIDAY MAGIC—STRAIGHT TO THEIR DOOR.</p>
		<p>This holiday season, send bigger, bolder, and more chocolate-y gifts with our new limited edition Chocolate Mint Chip Cake and Cake Truffles, epic Peppermint Bark Tie Dye Pie, and classic Milk Bar Cookie Tins.</p>
		<a class="action-btn" href="../pages/view_category.php?view_all=All">SHOP NOW</a>
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
	<a class="action-btn" href="../pages/view_category.php?view_all=All">SEE ALL OPTIONS</a>
</div>

<div class="benefits-page-break">
	<p>WHY WE'RE THE BEST</p>
	<div class="benefits-wrapper">
		<div class="benefits-item">
			<img src="../images/benefits-img-1.png" alt="">
			<P class="title">THOUGHTFULLY PACKAGED</P>
			<p>We make your treats fresh and flash-freeze ‘em for peak quality so you can enjoy them like they were just made.</p>
		</div>
		<div class="benefits-item">
			<img src="../images/benefits-img-2.png" alt="">
			<P class="title">NATIONWIDE DELIVERY</P>
			<p>If you're a last-minute gifter, we've got you covered with next-day delivery, anywhere in the USA.</p>
		</div>
		<div class="benefits-item">
			<img src="../images/benefits-img-3.png" alt="">
			<P class="title">NATURAL INGREDIENTS</P>
			<p>All of our products are baked with better-for-you, allergy-friendly ingredients so you can enjoy and share with confidence.</p>
		</div>
	</div>
</div>

<div class="gift-container">
	<div class="gift-descr">
		<p class="title">HAPPINESS DELIVERED</p>
		<p>The only thing better than opening a gift…is opening a gift that’s dessert. Make somebody's day bright by sending our best-selling, over-the-top treats today. Nationwide delivery in 1-2 days.</p>
		<a class="action-btn" href="../pages/view_category.php?view_all=All">SHOP NOW</a>
	</div>
	<div class="img-wrapper">
		<img class="gift-delivery" src="../images/delivery-box.webp" alt="">
	</div>
</div>

<hr>

<div class="business-info">
	<div>
		<p class="title">Gourmet Cookies, Cookie Cakes and Gifts for All Occasions</p>
		<p>Hungry for delicious, fresh-baked cookies delivered right to your door? Want to send a special treat to those you care about? Mrs. Fields gourmet gift baskets, cookies, and cookie cakes are made with the highest quality ingredients.</p>
		<p>Order cookies online for any occasion. A cookie basket delivery is the perfect gift for birthdays, anniversaries, Valentine's Day, Mother's Day, Father's Day, Christmas and the holidays, or any of life’s sweet occasions. Whatever your needs, we’re here to make gift-giving fun and convenient.</p>
	</div>
	<div>
		<p class="title">Cookie Delivery and Gift Baskets Galore</p>
		<p>Simply browse our wide selection of gourmet gifts and cookie baskets, then order your perfect gift online or call 1-800-COOKIES. Need a gourmet gift basket for an event or celebration? Mrs. Fields offers a delightful selection of brownie and cookie baskets that your guests are sure to love. Not finding the perfect combination of treats? Brighten someone’s day with a customized cookie basket delivery.</p>
	</div>
	<div>
		<p class="title">Corporate Business Treats</p>
		<p>Nothing says “thank you” quite like a box filled with fresh-baked treats! Shop Mrs. Fields to find the perfect gift for any corporate or business occasion. From employee appreciation to thank you gifts, we have a wide variety of business gift baskets, cookie tins, and boxes.</p>
		<p>Looking to design special cookie gifts for a company party or event? Customize our cookies with your company’s logo or your client’s logo for impactful gift-giving.</p>
	</div>
	<div>
		<p class="title">Hundreds of Locations Across the World</p>
		<p>Mrs. Fields has hundreds of cookie stores. Find a cookie shop near you by using our store locator. Browse our beautiful collection of personalized gift baskets, cookie gifts, cookie bouquets, and other memorable treats online. Send cookies by placing your order online or by calling 1-800-COOKIES.</p>
	</div>
</div>

<?php include("../templates/footer.php") ?>