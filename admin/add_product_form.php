<?php
include('../config/essentials.php');
include('config/edit_product.php');
if (isAdmin() === false) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../login.php');
}

?>

<?php include("templates/header.php"); ?>

<div class="header">
	<h2>Add product</h2>
</div>

<form method="post" action="add_product_form.php" enctype="multipart/form-data">
	<!-- notification message -->
	<?php include('templates/notifications.php'); ?>

	<div class="input-group">
		<label for="title">Title</label>
		<input type="text" id="title" name="title" value="<?php echo $title; ?>">
	</div>
	<!-- <div class="input-group">
		<label>Img Name</label>
		<input type="text" name="img_name" value="<?php echo $img_name; ?>">
	</div> -->
	<div class="input-group">
		<label for="product_img">Choose a product picture:</label>
		<input id="product_img" name="product_img" type="file" accept="image/png, image/jpeg, image/svg" />
	</div>
	<div class="input-group">
		<label>Category</label>
		<select name="category">
			<option value=""></option>
			<option value="watch">watch</option>
			<option value="bracelet">bracelet</option>
			<option value="cake">cake</option>
			<option value="pies">pies</option>
			<option value="cookies">cookies</option>
			<option value="ice-cream">ice cream</option>
		</select>
	</div>
	<div class="input-group">
		<label>Subcategory</label>
		<select name="subcategory">
			<option value="none">none</option>
			<option value="male">male</option>
			<option value="female">female</option>
			<option value="holiday">holiday</option>
		</select>
	</div>
	<div class="input-group">
		<label>Description</label>
		<textarea id="description" name="description"><?php echo htmlspecialchars($description); ?></textarea>
	</div>
	<div class="input-group">
		<label>Price</label>
		<input type="text" name="price" value="<?php echo $price; ?>">
	</div>
	<div class="input-group">
		<button type="submit" class="btn" name="add_product_btn">Add product</button>
	</div>
	<p>
		<a href="admin_home.php">Cancel</a>
	</p>
</form>

<?php include("templates/footer.php") ?>

<?php
$watches = grabAllProducts();
echo "<pre>" . print_r($watches, true) . "</pre>";
?>