<?php
// connect to the database
require_once('db_connect.php');
$pdo = pdo_connect_mysql();

if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

if (isset($_POST['add_cart'])) {
	// sleep(2);
	$user_id = $_POST['user_id'];
	if ($user_id == null || $user_id == false) {
		$product_id = $_POST['product_id'];
		$quantity = $_POST['quantity'];

		if (isset($_SESSION['shopping_cart'][$product_id])) {
			$_SESSION['shopping_cart'][$product_id]['quantity']++;
			echo json_encode('output null userr'); // for ajax
		} else {
			$added_product = array("product_id" => $product_id, "quantity" => $quantity);
			$added_product = array_merge($added_product, grabProduct2($product_id));
			$_SESSION['shopping_cart'][$product_id] = $added_product;

			$_SESSION['success']  = "New product successfully added!!";
			echo json_encode('output null userr'); // for ajax
		}
	} else {
		$product_id = $_POST['product_id'];
		$quantity = $_POST['quantity'];

		$query = "SELECT * FROM cart WHERE user_id=? AND product_id=?";
		$stmt = $pdo->prepare($query);
		$stmt->execute([$user_id, $product_id]);
		$rowCount = $stmt->rowCount();
		$product = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($rowCount > 0) {
			$query = "UPDATE cart SET quantity = ? WHERE id = ?";
			$stmt = $pdo->prepare($query);
			$stmt->execute([++$product['quantity'], $product['id']]);

			$_SESSION['success']  = "Additional item added";
		} else {
			$query = "INSERT INTO cart(user_id, product_id, quantity) VALUES(?,?,?)";
			$stmt = $pdo->prepare($query);
			$stmt->execute([$user_id, $product_id, $quantity]);

			$_SESSION['success']  = "New product successfully added!!";
		}

		echo json_encode('output logged in userr'); //for ajax response
	}
};

if (isset($_POST['update_cart'])) {
	$updated_quantity = $_POST['quantity'];
	$update_id = $_POST['cart_id'];
	if ($user_id == null) {
		$_SESSION["shopping_cart"][$update_id]['quantity'] = $updated_quantity;
	} else {
		$query = "UPDATE cart SET quantity = ? WHERE id = ?";
		$stmt = $pdo->prepare($query);
		$stmt->execute([$updated_quantity, $update_id]);
	}
	$_SESSION['success']  = "Cart updated";
};

if (isset($_GET['delete_from_cart'])) {
	$remove_id = $_GET['delete_from_cart'];
	if ($user_id == null) {
		unset($_SESSION["shopping_cart"][$remove_id]);
	} else {
		global $pdo;
		try {
			$query = "DELETE FROM cart WHERE id = ?";
			$stmt = $pdo->prepare($query);
			$stmt->execute([$remove_id]);
		} catch (PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
		};
	}
	$_SESSION['success']  = "Product removed";
};

if (isset($_GET['delete_all_cart'])) {
	deleteAllFromCart();
	$_SESSION['success']  = "All products removed";
};
function deleteAllFromCart()
{
	if (isLoggedIn()) {
		global $user_id;
		global $pdo;
		$query = "DELETE FROM cart WHERE user_id = ?";
		$stmt = $pdo->prepare($query);
		$stmt->execute([$user_id]);
	} else {
		$_SESSION['shopping_cart'] = array();
	}
}


// upon logging in merges guest cart to logged in user
function mergeGuestCartWithUser($guestCart, $userID)
{
	global $pdo;
	$productIDs = array_keys($guestCart);

	// grabbing matched guest products with user products
	$in  = str_repeat('?,', count($productIDs) - 1) . '?';
	$query = "SELECT * FROM cart WHERE product_id in ($in) AND user_id = ?";
	$stmt = $pdo->prepare($query);
	$params = array_merge($productIDs, [$userID]);
	$stmt->execute($params);
	$userCart = $stmt->fetchAll(PDO::FETCH_ASSOC);

	// $userCartProductIDs = array_column($userCart, 'product_id');
	// merging guest and user cart.

	$updateCartSql = "UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?";
	$updateStmt = $pdo->prepare($updateCartSql);
	$insertToUserCartSql = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?,?,?)";
	$insertCartStmt = $pdo->prepare($insertToUserCartSql);

	foreach ($guestCart as $key => $guest) {
		$loopCounter = 0;
		foreach ($userCart as $userProduct) {
			if ($userProduct['product_id'] == $key) {
				// updates db quantity to if guest exist
				if ($userProduct['quantity'] == $guest['quantity']) {
					break;
				} else {
					$updateStmt->execute([$guest['quantity'], $userID, $key]);
					break;
				}
			} else $loopCounter++;

			if ($loopCounter == count($userCart)) {
				// adds to db if guest doesnt exist in db
				$insertCartStmt->execute([$userID, $key, $guest['quantity']]);
			}
		}
	}
}

// checkout below
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

function calcTotalPrice($cartArray)
{
	$total_price = 0;
	foreach ($cartArray as $product) {
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

// this is for ajax of guest cart
function grabProduct2($product_id)
{
	global $pdo;
	$query = "SELECT * FROM products WHERE id = ?";

	$stmt = $pdo->prepare($query);
	$stmt->execute([$product_id]);
	$product = $stmt->fetch(PDO::FETCH_ASSOC);

	return $product;
}
