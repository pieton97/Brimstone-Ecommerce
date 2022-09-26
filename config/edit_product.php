<?php 
session_start();

// connect to the database
require_once('db_connect.php');
$pdo = pdo_connect_mysql();

// variable declaration
$title = "";
$img_name = "";
$description = "";
$price = "";
$errors = array(); 

// add product
if (isset($_POST['add_product_btn'])) 
{
	addProduct();
}

function addProduct()
{
	global $pdo,$title, $img_name, $description, $price, $errors;

  // receive all input values from the form.
	$title        =  $_POST['title'];
	$img_name     =  $_POST['img_name'];
	$description  =  $_POST['description'];
	$price        =  $_POST['price'];

  // form validation: ensure that the form is correctly filled
	if (empty($title)) { 
		array_push($errors, "Title is required"); 
	}
	if (empty($img_name)) { 
		array_push($errors, "Img_name is required"); 
	}
	if (empty($description)) { 
		array_push($errors, "Description is required"); 
	}
	if (empty($price)) { 
		array_push($errors, "Price is required"); 
	}

  // register user if there are no errors in the form
	if (count($errors) == 0) {
    $query = "INSERT INTO products (title, img_name, description, price) 
    VALUES(?, ?, ?, ?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$title,$img_name,$description,$price]);

    $_SESSION['success']  = "New product successfully added!!";
    header('location: ../admin/home.php');
	}
}

// edit product
if (isset($_POST['edit_product_btn'])) 
{
	editProduct();
}

function editProduct() {

}

// delete product
if (isset($_POST['delete'])) 
{
	deleteProduct();
}

function deleteProduct() {
  global $pdo;
  $id_to_delete = $_POST['id_to_delete'];
  try {
    // sql to delete a record
    $sql = "DELETE FROM products WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_to_delete]);
    header('Location: ../admin/home.php');
  } catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
  }
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

function isAdmin()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
		return true;
	}else{
		return false;
	}
}

?>
