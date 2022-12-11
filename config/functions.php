<?php
// Functions to manage users(register,delete,login) and grab info

// connect to the database
require_once('db_connect.php');
$pdo = pdo_connect_mysql();

// variable declaration
$username = "";
$email    = "";

// call the register() function if register_btn is clicked
if (isset($_POST['register_btn'])) {
	register();
}
// REGISTER USER
function register()
{
	global $pdo, $username, $email, $errors;

	// receive all input values from the form.
	$username    =  $_POST['username'];
	$email       =  $_POST['email'];
	$password_1  =  $_POST['password_1'];
	$password_2  =  $_POST['password_2'];

	// form validation: ensure that the form is correctly filled
	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($email)) {
		array_push($errors, "Email is required");
	}
	if (empty($password_1)) {
		array_push($errors, "Password is required");
	}
	if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
	}

	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$password = md5($password_1);

		if (isset($_POST['user_type'])) {
			// this portion is for admins to create users
			$user_type = $_POST['user_type'];
			$query = "INSERT INTO users (username, email, user_type, password) VALUES(?, ?, ?, ?)";
			$stmt = $pdo->prepare($query);
			$stmt->execute([$username, $email, $user_type, $password]);

			$_SESSION['success']  = "New user successfully created!!";
			header('location: admin_home.php');
		} else {
			$query = "INSERT INTO users (username, email, user_type, password) 
			VALUES(?, ?, 'user', ?)";
			$stmt = $pdo->prepare($query);
			$stmt->execute([$username, $email, $password]);

			// get id of the created user
			$logged_in_user_id = $pdo->lastInsertId();
			// merges guest cart with user current cart
			if (count($_SESSION['shopping_cart']) > 0) {
				mergeGuestCartWithUser($_SESSION['shopping_cart'], $logged_in_user_id);
			}
			$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
			$_SESSION['success']  = "You are now logged in";
			header('location: ../pages/homepage.php');
		}
	}
}

// return user array from their id
function getUserById($id)
{
	global $pdo;
	$query = "SELECT * FROM users WHERE id=?";
	$stmt = $pdo->prepare($query);
	$stmt->execute([$id]);
	$user = $stmt->fetch();

	return $user;
}

// call the login() function if register_btn is clicked
if (isset($_POST['login_btn'])) {
	login();
}

// LOGIN USER
function login()
{
	global $pdo, $username, $errors;

	// grap form values
	$username = $_POST['username'];
	$password = $_POST['password'];

	// make sure form is filled properly
	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {
		$password = md5($password);

		$query = "SELECT * FROM users WHERE username=? AND password=? LIMIT 1";
		$stmt = $pdo->prepare($query);
		$stmt->execute([$username, $password]);
		$rowCount = $stmt->rowCount();
		$user = $stmt->fetch();


		if ($rowCount == 1) { // user found
			// check if user is admin or user
			$logged_in_user = $user;
			if ($logged_in_user['user_type'] == 'admin') {
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";
				header('Location: ../admin/admin_home.php');
			} else {
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";
				header('Location: ../pages/homepage.php');
			}
			// merges guest cart with user current cart
			if (count($_SESSION['shopping_cart']) > 0) {
				mergeGuestCartWithUser($_SESSION['shopping_cart'], $user['id']);
			}
		} else {
			array_push($errors, "Wrong username/password combination");
		}
	}
}

// delete user
if (isset($_GET['delete_user'])) {
	deleteUser();
}
function deleteUser()
{
	global $pdo;
	$id_to_delete = $_GET['delete_user'];
	try {
		$sql = "DELETE FROM users WHERE id=?";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([$id_to_delete]);
		$sql2 = "DELETE FROM cart WHERE user_id=?";
		$stmt2 = $pdo->prepare($sql2);
		$stmt2->execute([$id_to_delete]);
	} catch (PDOException $e) {
		echo $sql . "<br>" . $e->getMessage();
	}
	$_SESSION['success']  = "User removed";
}
