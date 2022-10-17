<?php 
session_start();

echo getcwd() . "<br>";
chdir('C://xampp/htdocs/brimstone');
echo getcwd() . "<br>";
// chdir($_SERVER['HOMEPATH']);

// tells you if a user is logged in or not
function isLoggedIn()
{
	if (isset($_SESSION['user'])) {
		return true;
	}else{
		return false;
	}
}

// checks if logged in user is an admin
function isAdmin()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
		return true;
	}else{
		return false;
	}
}

if (isset($_GET['logout'])) 
{
	session_destroy();
	unset($_SESSION['user']);
	header("Location: ../pages/login.php");
}

// error messages for forms
$errors = array();
function display_error()
{
	global $errors;
	if (count($errors) > 0) 
	{
		echo '<div class="error">';
		foreach ($errors as $error) {
			echo $error . '<br>';
		}
		echo '</div>';
	}
}

function grabAllWatches() 
{
	global $pdo;
	$query = "SELECT * FROM products";
	$stmt = $pdo->prepare($query);
	$stmt->execute();
	$watches = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $watches;
}

function grabUserCart()
{
	global $pdo;
	$userID = $_SESSION['user']['id'];
	// $sql = "SELECT * FROM cart WHERE user_id=?";

	$sql = "SELECT c.id AS cart_id, c.user_id, c.quantity, p.title, p.img_name, p.price 
	FROM cart AS c LEFT JOIN products AS p ON p.id = c.product_id 
	WHERE user_id=?";

	// $sql = "SELECT user_id, title, img_name, price FROM products 
	// LEFT JOIN (SELECT product_id FROM cart WHERE user_id=?) 
	// ON product_id = products.id";

	
	// $sql = "SELECT user_id, title, img_name, price FROM products 
	// LEFT JOIN cart AS c
	// ON c.product_id = products.id";

	// $sql = "SELECT * FROM products 
	// WHERE id IN (SELECT product_id FROM cart WHERE user_id=?)";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$userID]);
	$cart = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $cart;
}

function grabAllUsers() 
{
	global $pdo;
	$query = "SELECT * FROM users ORDER BY user_type ASC";
	$stmt = $pdo->prepare($query);
	$stmt->execute();
	$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $users;
}

?>

