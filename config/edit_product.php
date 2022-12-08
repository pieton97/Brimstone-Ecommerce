<?php
// connect to the database
require_once('db_connect.php');
$pdo = pdo_connect_mysql();
echo __DIR__;
// variable declaration
$title = "";
$img_name = "";
$category = "";
$subcategory = "";
$description = "";
$price = "";

// add/edit product
if (isset($_POST['add_product_btn']) || isset($_POST['edit_product_btn'])) {
	addProduct();
}
function addProduct()
{
	global $pdo, $title, $img_name, $category, $subcategory, $description, $price, $errors;

	// receive all input values from the form.
	$title        =  $_POST['title'];
	// $img_name     =  $_POST['img_name'];
	$category     =  $_POST['category'];
	$subcategory    		=  $_POST['subcategory'];
	$description  =  $_POST['description'];
	$price        =  $_POST['price'];
	echo "<pre>" . print_r($_FILES['product_img'], true) . "</pre>";

	if (empty($title)) {
		array_push($errors, "Title is required");
	}
	// if (empty($img_name)) {
	// 	array_push($errors, "Img_name is required");
	// }
	if (empty($category)) {
		array_push($errors, "Category is required");
	}
	if (empty($subcategory)) {
		array_push($errors, "subcategory is required");
	}
	if (empty($description)) {
		array_push($errors, "Description is required");
	}
	if (empty($price)) {
		array_push($errors, "Price is required");
	}

	if (count($errors) == 0 && isset($_POST['add_product_btn'])) {
		// checks if file uploaded is too large
		if (($_FILES['product_img']['size'] >= 2097152) || ($_FILES["product_img"]["size"] == 0)) {
			array_push($errors, 'File too large. File must be less than 2 megabytes.');
		}

		$img_name = basename($_FILES["product_img"]['name']);
		// adds new product to db
		$query = "INSERT INTO products (title,img_name,category,subcategory,description,price) 
    VALUES(?,?,?,?,?,?)";
		$stmt = $pdo->prepare($query);
		$stmt->execute([$title, $img_name, $category, $subcategory, $description, $price]);

		$uploadDir = __DIR__ . '/../product_images/' . basename($_FILES["product_img"]['name']);
		move_uploaded_file($_FILES['product_img']['tmp_name'], $uploadDir);

		$_SESSION['success']  = "New product successfully added";
		header('location: ../admin/admin_home.php');
	} else if (count($errors) == 0 && isset($_POST['edit_product_btn'])) {
		// update existing product info
		$img_name  = $_POST['img_name'];
		$update_id = $_POST['update_id'];

		$query = "UPDATE products 
		SET title=?,img_name=?,category=?,subcategory=?,description=?,price=? 
		WHERE id = ?";
		$stmt = $pdo->prepare($query);
		$stmt->execute([$title, $img_name, $category, $subcategory, $description, $price, $update_id]);

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
	$img_file_name = $_GET['img_name'];
	try {
		$sql = "DELETE FROM products WHERE id=?";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([$id_to_delete]);
		debug_to_console(getcwd());
		unlink(getcwd() . './product_images/' . $img_file_name);
		header('Location: ../admin/admin_home.php');
	} catch (PDOException $e) {
		echo $sql . "<br>" . $e->getMessage();
	}
	$_SESSION['success']  = "Product removed";
}
