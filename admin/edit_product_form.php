<?php
include('../config/essentials.php');
include('../config/edit_product.php');

if (isAdmin() === false) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../pages/login.php');
}

// populates clicked product information to inputs
if (isset($_GET['update'])) {
	$update_id = $_GET['update'];
	$query = "SELECT * FROM products WHERE id = ?";
	$stmt = $pdo->prepare($query);
	$stmt->execute([$update_id]);
	$product = $stmt->fetch(PDO::FETCH_ASSOC);
	$title        =  $product['title'];
	$img_name     =  $product['img_name'];
	$category     =  $product['category'];
	$subcategory  =  $product['subcategory'];
	$description  =  $product['description'];
	$price        =  $product['price'];
}
?>


<?php include("../templates/header.php"); ?>

<div class="form-wrapper">
	<div>
		<h2>Edit product</h2>
	</div>

	<form class="product-form" method="post" action="edit_product_form.php">
		<div>
			<label for="title">Title</label>
			<input type="text" id="title" name="title" value="<?php echo $title; ?>">
		</div>
		<div>
			<label>Img Name</label>
			<input type="text" name="img_name" value="<?php echo $img_name; ?>">
		</div>
		<div>
			<label>Category</label>
			<select name="category">
				<option value="<?php echo $category; ?>"><?php echo $category; ?> (current)</option>
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
			<select name="subcategory">
				<option value="<?php echo $subcategory; ?>"><?php echo $subcategory; ?> (current)</option>
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
			<input type="text" name="price" value="<?php echo $price; ?>">
		</div>
		<div>
			<button type="submit" name="edit_product_btn">Edit product</button>
			<p><a href="admin_products.php">Cancel</a></p>
		</div>
		<input type="hidden" name="update_id" value="<?php echo $update_id; ?>">
	</form>
</div>

<?php include("../templates/footer.php") ?>