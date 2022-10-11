<?php 
session_start();

// connect to the database
require_once('db_connect.php');
$pdo = pdo_connect_mysql();

// variable declaration
$username = "";
$email    = "";
$errors   = array(); 

// call the register() function if register_btn is clicked
if (isset($_POST['register_btn'])) 
{
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
			$user_type = $_POST['user_type'];
			$query = "INSERT INTO users (username, email, user_type, password) 
      VALUES(?, ?, ?, ?)";
      $stmt = $pdo->prepare($query);
      $stmt->execute([$username,$email,$user_type,$password]);

			$_SESSION['success']  = "New user successfully created!!";
			header('location: home.php');
		}else{
			$query = "INSERT INTO users (username, email, user_type, password) 
			VALUES(?, ?, 'user', ?)";
      $stmt = $pdo->prepare($query);
      $stmt->execute([$username,$email,$password]);

			// get id of the created user
			$logged_in_user_id = $pdo->lastInsertId();

			$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
			$_SESSION['success']  = "You are now logged in";
			header('location: index.php');				
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

function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}	

// log user out if logout button clicked
if (isset($_GET['logout'])) 
{
	session_destroy();
	unset($_SESSION['user']);
	header("location: ../pages/login.php");
}

// call the login() function if register_btn is clicked
if (isset($_POST['login_btn'])) 
{
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
    $stmt->execute([$username,$password]);
    $rowCount = $stmt->rowCount();
    $user = $stmt->fetch();


		if ($rowCount == 1) { // user found
			// check if user is admin or user
			$logged_in_user = $user;
			if ($logged_in_user['user_type'] == 'admin') {

				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";
				header('location: ../admin/home.php');		  
			}
      else {
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";

				header('location: index.php');
			}
		}
    else {
			array_push($errors, "Wrong username/password combination");
		}
	}
}

