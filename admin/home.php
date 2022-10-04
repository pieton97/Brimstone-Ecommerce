<?php 
include('../functions.php');
include('../config/edit_cart.php');
// include('../config/edit_product.php');

if (isAdmin() === false) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../login.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: ../login.php");
}

$query = "SELECT * FROM products";
$stmt = $pdo->prepare($query);
$stmt->execute();
$watches = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM cart";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$cart = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Brimstone Collective</title>
	<link rel="stylesheet" type="text/css" href="../styles/style.css">
	<link rel="stylesheet" type="text/css" href="../styles/style2.css">
</head>
<body>
  <?php include("../templates/header.php") ?>

	<div class="header">
		<h2>Welcome Administrator, Home</h2>
	</div>
	<div class="content">
		<!-- notification message -->
    <div onclick="this.remove()"><?php echo display_error(); ?></div>
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" onclick="this.remove()">
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>

		<!-- logged in user information -->
		<div class="profile_info">
			<img src="../images/admin_profile.jpg"  >

			<div>
				<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong>

					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<br>
						<a href="home.php?logout='1'" style="color: red;">logout</a>
                       &nbsp; <a href="create_user.php"> add user</a>
					</small>

				<?php endif ?>
			</div>
		</div>
	</div>
  <!-- Editing products -->
  <div class="products-container">
    <div class="edit-products">
      <p>Current products:</p>
      <a href="add_product_form.php">add product</a>
    </div>
    <?php foreach($watches as $watch){ ?>  
      <div class="product">
        <p><?php echo $watch['title']; ?></p>
        <img class="product-img" src="../product_images/<?php echo $watch['img_name']?>.png" alt="">
        <p>$<?php echo $watch['price'] ?></p>

        <!-- update product info -->
        <a href="edit_product_form.php?update=<?php echo $watch['id']; ?>">Update</a>
        
        <!-- delete product -->
        <a href="add_product_form.php?delete=<?php echo $watch['id']; ?>">Delete</a>

        <!-- adds to cart -->
        <form method="post" action="home.php">
          <input type="number" min="1" max="10" name="quantity" value="1">
          <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['id']; ?>">
          <input type="hidden" name="product_id" value="<?php echo $watch['id']; ?>">
          <input type="submit" name="add_cart" value="add to cart" class="btn brand z-depth-0">
			  </form>
      </div>
    <?php } ?>
  </div>

  <?php include("../templates/footer.php") ?>
  <hr>
</body>
</html>

<?php 
echo "<pre>".print_r($cart,true)."</pre>";
echo "<pre>".print_r($watches,true)."</pre>";
?>
