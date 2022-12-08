<?php
// connect to the database
require_once('db_connect.php');
$pdo = pdo_connect_mysql();

if (isset($_POST['add_cart'])) {
	// sleep(2);
	$user_id = $_POST['user_id'];
	if ($user_id == null) {
		header('location: ../pages/login.php');
	}
	$product_id = $_POST['product_id'];
	$quantity = $_POST['quantity'];

	$query = "SELECT * FROM `cart` WHERE user_id=? AND product_id=?";
	$stmt = $pdo->prepare($query);
	$stmt->execute([$user_id, $product_id]);
	$rowCount = $stmt->rowCount();

	if ($rowCount > 0) {
		array_push($errors, "Already in cart");
	} else {
		$query = "INSERT INTO cart(user_id, product_id, quantity) VALUES(?,?,?)";
		$stmt = $pdo->prepare($query);
		$stmt->execute([$user_id, $product_id, $quantity]);

		$_SESSION['success']  = "New product successfully added!!";
	}

	echo json_encode('output test123');
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
	deleteAllFromCart();
	$_SESSION['success']  = "All products removed";
	header('location: ../pages/cart.php');
};
function deleteAllFromCart()
{
	global $user_id;
	global $pdo;
	$query = "DELETE FROM cart WHERE user_id = ?";
	$stmt = $pdo->prepare($query);
	$stmt->execute([$user_id]);
}

$email = "";
$fName = "";
$lName = "";
$address = "";
$phone = "";
$paymentType = "";
$totalPaid = "";
$purchasedItems = "";
if (isset($_POST['checkout_cart'])) {
	$email = $_POST['email'];
	$fName = $_POST['first_name'];
	$lName = $_POST['last_name'];
	$address = $_POST['address'];
	$phone = $_POST['phone'];
	$totalPaid = $_POST['total_paid'];
	$paymentType = $_POST['payment'];
	$curPurchase = base64_decode($_POST['purchased_items']);

	$query = 'INSERT INTO placed_orders 
	(account_id,email,fname,lname,address,phone,total_paid,payment_type,items_bought)
	VALUES(?,?,?,?,?,?,?,?,?)';
	$stmt = $pdo->prepare($query);
	$stmt->execute([$user_id, $email, $fName, $lName, $address, $phone, $totalPaid, $paymentType, $curPurchase]);

	deleteAllFromCart();
	header('location: ../pages/my_account.php');

	// echo "<pre>" . print_r($curPurchase, true) . "</pre>";
};

function calcTotalPrice()
{
	$total_price = 0;
	foreach (grabUserCart() as $product) {
		$total_price += $product["price"] * $product["quantity"];
	};
	return $total_price;
}

// managing placed orders from admin panel
function grabAllOrders()
{
	global $pdo;
	$query = "SELECT * FROM placed_orders";
	$stmt = $pdo->prepare($query);
	$stmt->execute();
	$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

	return $orders;
};

if (isset($_GET['cancel_order'])) {
	global $pdo;
	try {
		$order_id = $_GET['cancel_order'];
		$query = "DELETE FROM placed_orders WHERE id = ?";
		$stmt = $pdo->prepare($query);
		$stmt->execute([$order_id]);
	} catch (PDOException $e) {
		echo $sql . "<br>" . $e->getMessage();
	};

	$_SESSION['success']  = "Order Canceled";
};
