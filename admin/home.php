<?php 
include('../functions.php');
include('../config/add_cart.php');

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
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
	<style>
    .header {
      background: #003366;
    }
    button[name=register_btn] {
      background: #003366;
    }
    .product-img {
      width: 100px;
    }
    .products-container {
      display: block;
      width: 50%;
      margin: 30px auto;
      font-size: 1rem;
    }
    .edit-products {
      text-align: center;
      font-size: 18px;
      margin: 10px auto;
    }
    .product {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 50px;
    }
    .yellow {
      background-color: yellow;
      color: black;
    }
	</style>
</head>

<body>
	<div class="header">
		<h2>Welcome Administrator, Home</h2>
	</div>
	<div class="content">
		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
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
			<img src="../images/admin_profile.png"  >

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

        <form method="post" action="edit_product_form.php">
          <input type="hidden" name="id_to_update" value="<?php echo $watch['id']; ?>">
          <input type="submit" name="update" value="update" class="btn yellow">
			  </form>
        <form method="post" action="add_product_form.php">
          <input type="hidden" name="id_to_delete" value="<?php echo $watch['id']; ?>">
          <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
			  </form>
        <form method="post" action="home.php">
          <input type="number" name="quantity">
          <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['id']; ?>">
          <input type="hidden" name="product_id" value="<?php echo $watch['id']; ?>">
          <input type="submit" name="add_cart" value="add to cart" class="btn brand z-depth-0">
			  </form>
      </div>
    <?php } ?>
  </div>

  <hr>
</body>
</html>

<?php 
echo "<pre>".print_r($cart,true)."</pre>";
echo "<pre>".print_r($watches,true)."</pre>";
?>
