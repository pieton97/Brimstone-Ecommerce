<?php
// connect to the database
require_once('db_connect.php');
$pdo = pdo_connect_mysql();

// variable declaration
$title = "";
$img_name = "";
$category = "";
$gender = "";
$description = "";
$price = "";

// add/edit product
if (isset($_POST['add_product_btn']) || isset($_POST['edit_product_btn'])) {
	addProduct();
}
function addProduct()
{
	global $pdo, $title, $img_name, $category, $gender, $description, $price, $errors;

	// receive all input values from the form.
	$title        =  $_POST['title'];
	$img_name     =  $_POST['img_name'];
	$category     =  $_POST['category'];
	$gender    		=  $_POST['gender'];
	$description  =  $_POST['description'];
	$price        =  $_POST['price'];

	if (empty($title)) {
		array_push($errors, "Title is required");
	}
	if (empty($img_name)) {
		array_push($errors, "Img_name is required");
	}
	if (empty($category)) {
		array_push($errors, "Category is required");
	}
	if (empty($gender)) {
		array_push($errors, "Gender is required");
	}
	if (empty($description)) {
		array_push($errors, "Description is required");
	}
	if (empty($price)) {
		array_push($errors, "Price is required");
	}

	if (count($errors) == 0 && isset($_POST['add_product_btn'])) 
	{
		// adds new product to db
		$query = "INSERT INTO products (title,img_name,category,gender,description,price) 
    VALUES(?,?,?,?,?,?)";
		$stmt = $pdo->prepare($query);
		$stmt->execute([$title,$img_name,$category,$gender,$description,$price]);

		$_SESSION['success']  = "New product successfully added";
		header('location: ../admin/admin_home.php');
	} 
	else if (count($errors) == 0 && isset($_POST['edit_product_btn'])) 
	{ 
		// update existing product info
		$update_id = $_POST['update_id'];

		$query = "UPDATE products 
		SET title=?,img_name=?,category=?,gender=?,description=?,price=? 
		WHERE id = ?";
		$stmt = $pdo->prepare($query);
		$stmt->execute([$title,$img_name,$category,$gender,$description,$price,$update_id]);

		$_SESSION['success']  = "Product edit successful";
		header('location: ../admin/admin_home.php');
	}
}

// delete product
if (isset($_GET['delete'])) {
	deleteProduct();
}
function deleteProduct()
{
	global $pdo;
	$id_to_delete = $_GET['delete'];
	try {
		$sql = "DELETE FROM products WHERE id=?";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([$id_to_delete]);
		header('Location: ../admin/admin_home.php');
	} catch (PDOException $e) {
		echo $sql . "<br>" . $e->getMessage();
	}
	$_SESSION['success']  = "Product removed";
}
