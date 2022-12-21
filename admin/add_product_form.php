<?php
include('../config/essentials.php');
include('../config/edit_product.php');
if (isAdmin() === false) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../pages/login.php');
}
?>

<?php include("../templates/header.php"); ?>

<div class="form-wrapper">
	<div>
		<h2>Add product</h2>
	</div>
	<div class="error" onclick="this.remove()"><?php echo display_error(); ?></div>

	<form class="product-form" method="post" action="add_product_form.php" enctype="multipart/form-data">
		<div>
			<label for="title">Title</label>
			<input type="text" id="title" name="title" value="<?php echo $title; ?>" required>
		</div>
		<div>
			<label for="product_img">Choose a product picture:</label>
			<input id="product_img" name="product_img" type="file" accept="image/png, image/jpeg, image/svg" required />
		</div>
		<div>
			<label>Category</label>
			<select name="category" required>
				<option value="none">None</option>
				<option value="cookies">Cookies</option>
				<option value="cake">Cake</option>
				<option value="ice-cream">Ice cream</option>
				<option value="mochi">Mochi</option>
				<!-- <option value="cookbooks">Cookbooks</option> -->
			</select>
		</div>
		<div>
			<label>Subcategory</label>
			<select name="subcategory" required>
				<option value="none">None</option>
				<option value="gifts">Gifts</option>
				<option value="featured">Featured</option>
				<option value="others">Others</option>
			</select>
		</div>
		<div>
			<label>Description</label>
			<textarea id="description" name="description"><?php echo htmlspecialchars($description); ?></textarea>
		</div>
		<div>
			<label>Price</label>
			<input type="text" name="price" value="<?php echo $price; ?>" required>
		</div>
		<div>
			<button type="submit" name="add_product_btn">Add product</button>
			<p><a href="admin_products.php">Cancel</a></p>
		</div>
	</form>
</div>

<?php include("../templates/footer.php") ?>