<?php
include('../config/essentials.php');
if (isAdmin() === false) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../pages/login.php');
};
include('../config/functions.php');
include('../config/edit_cart.php');

$products = grabAllProducts();
$count = count($products);
?>

<?php include("../templates/header.php"); ?>

<div class="profile-main-wrapper">
	<div class="profile-banner">
		<div class="profile-title">
			<p>Admin Home</p>
			<hr>
		</div>
		<div>
			<?php include('../templates/profile_info.php'); ?>
			<a href="../admin/create_user.php">Create user</a>
		</div>
	</div>

	<div class="profile-content">
		<?php include("../templates/admin-navbar.php"); ?>

		<!-- Editing products -->
		<div class="admin-product-wrapper">
			<p class="secret-note">note: please dont delete too many products so I dont have to constantly restore the db, thanks! :)</p>
			<div class="admin-product-header">
				<p>Current products: (<?php echo $count ?> count) <a href="add_product_form.php">Add product</a></p>
			</div>
			<div class="admin-products">
				<?php foreach ($products as $product) { ?>
					<div class="admin-product">
						<img class="product-img" src="../product_images/<?php echo $product['img_name'] ?>" alt="">
						<div class="admin-product-details">
							<p class="title"><?php echo $product['title']; ?></p>
							<p>$<?php echo formatPrice($product['price']) ?></p>
							<p><?php echo $product['category'] . "<br>" . $product['subcategory'] ?></p>

							<!-- update product info -->
							<a href="edit_product_form.php?update=<?php echo $product['id']; ?>">Update</a>
							<!-- delete product -->
							<a href="admin_home.php?delete=<?php echo $product['id'] . '&img_name=' . $product['img_name']; ?>" onclick="return confirm('Pernamently remove this product?');">Delete</a>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

<?php include("../templates/footer.php") ?>