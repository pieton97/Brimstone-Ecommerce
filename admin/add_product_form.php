<?php 
include('../config/edit_product.php');
if (isAdmin() === false) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../login.php');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Registration system PHP and MySQL</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
	<div class="header">
		<h2>Add product</h2>
	</div>

	<form method="post" action="add_product_form.php">
    <?php echo display_error(); ?>
    <div class="input-group">
      <label for="title">Title</label>
      <input type="text" id="title" name="title" value="<?php echo $title; ?>">
    </div>
    <div class="input-group">
      <label>Img Name</label>
      <input type="text" name="img_name" value="<?php echo $img_name; ?>">
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
      <button type="submit" class="btn" name="add_product_btn">Add product</button>
    </div>
    <p>
      <a href="home.php">Cancel</a>
    </p>
  </form>

  <hr>
</body>
</html>

<?php 
$query = "SELECT * FROM products";
$stmt = $pdo->prepare($query);
$stmt->execute();
$watches = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "<pre>".print_r($watches,true)."</pre>";
?>
