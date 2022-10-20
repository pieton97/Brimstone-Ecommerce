<?php
// session_start();

// connect to the database
require_once('db_connect.php');
$pdo = pdo_connect_mysql();
$user_id = $_SESSION['user']['id'];
// echo $user_id;
// echo "<pre>".print_r($user_id,true)."</pre>";


if (isset($_POST['add_cart'])) {
	// sleep(2);
	$user_id = $_POST['user_id'];
	$product_id = $_POST['product_id'];
	$quantity = $_POST['quantity'];
	$location = $_POST['location'];

	$query = "SELECT * FROM `cart` WHERE user_id=? AND product_id=?";
	$stmt = $pdo->prepare($query);
	$stmt->execute([$user_id, $product_id]);
	$rowCount = $stmt->rowCount();


	if ($rowCount > 0) {
		array_push($errors, "Already in cart");
		// header("location: $location");
	} else {
		$query = "INSERT INTO `cart`(user_id, product_id, quantity) VALUES(?,?,?)";
		$stmt = $pdo->prepare($query);
		$stmt->execute([$user_id, $product_id, $quantity]);

		$_SESSION['success']  = "New product successfully added!!";
		// header("location: $location");
	}
};

if (isset($_POST['update_cart'])) {
	$updated_quantity = $_POST['quantity'];
	$update_id = $_POST['cart_id'];

	$query = "UPDATE cart SET quantity = ? WHERE id = ?";
	$stmt = $pdo->prepare($query);
	$stmt->execute([$updated_quantity, $update_id]);

	$_SESSION['success']  = "Cart updated";
};


if (isset($_GET['delete_from_cart'])) {
	global $pdo;
	try {
		$remove_id = $_GET['delete_from_cart'];
		$query = "DELETE FROM cart WHERE id = ?";
		$stmt = $pdo->prepare($query);
		$stmt->execute([$remove_id]);
	} catch (PDOException $e) {
		echo $sql . "<br>" . $e->getMessage();
	};

	$_SESSION['success']  = "Product removed";

	header('location: ../pages/cart.php');
};

if (isset($_GET['delete_all_cart'])) {
	global $user_id;
	$query = "DELETE FROM cart WHERE user_id = ?";
	$stmt = $pdo->prepare($query);
	$stmt->execute([$user_id]);

	$_SESSION['success']  = "All products removed";

	header('location: ../pages/cart.php');
};
