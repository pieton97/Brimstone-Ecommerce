<?php
include('../config/essentials.php');
include('config/edit_product.php');

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
	$watch = $stmt->fetch(PDO::FETCH_ASSOC);
	echo "<pre>" . print_r($watch, true) . "</pre>";
	$title        =  $watch['title'];
	$img_name     =  $watch['img_name'];
	$category     =  $watch['category'];
	$gender    		=  $watch['gender'];
	$description  =  $watch['description'];
	$price        =  $watch['price'];
}
?>

<?php include("templates/header.php"); ?>
<div class="header">
	<h2>Edit product</h2>
</div>

<form method="post" action="edit_product_form.php">
	<!-- notification message -->
	<?php include('templates/notifications.php'); ?>
	
	<div class="input-group">
		<label for="title">Title</label>
		<input type="text" id="title" name="title" value="<?php echo $title; ?>">
	</div>
	<div class="input-group">
		<label>Img Name</label>
		<input type="text" name="img_name" value="<?php echo $img_name; ?>">
	</div>
	<div class="input-group">
		<label>Category</label>
		<select name="category">
			<option value="<?php echo $category; ?>"><?php echo $category; ?> (current)</option>
			<option value="watch">watch</option>
			<option value="bracelet">bracelet</option>
		</select>
	</div>
	<div class="input-group">
		<label>Gender</label>
		<select name="gender">
			<option value="<?php echo $gender; ?>"><?php echo $gender; ?> (current)</option>
			<option value="male">male</option>
			<option value="female">female</option>
		</select>
	</div>
	<div class="input-group">
		<label>Description</label>
		<input type="text" name="description" value="<?php echo $description; ?>">
	</div>
	<div class="input-group">
		<label>Price</label>
		<input type="text" name="price" value="<?php echo $price; ?>">
	</div>
	<div class="input-group">
		<button type="submit" class="btn" name="edit_product_btn">Edit product</button>
	</div>
	<input type="hidden" name="update_id" value="<?php echo $update_id; ?>">
	<p>
		<a href="admin_home.php">Cancel</a>
	</p>
</form>

<?php include("templates/footer.php") ?>

<?php
$watches = grabAllWatches();
echo "<pre>" . print_r($watches, true) . "</pre>";
?>
