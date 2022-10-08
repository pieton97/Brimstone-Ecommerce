<?php 
// session_start();

// connect to the database
require_once('db_connect.php');
$pdo = pdo_connect_mysql();


if (isset($_POST['add_cart']))
{
  $user_id = $_POST['user_id'];
  $product_id = $_POST['product_id'];
  $quantity = $_POST['quantity'];

  $query = "SELECT * FROM `cart` WHERE user_id=? AND product_id=?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$user_id,$product_id]);
  $rowCount = $stmt->rowCount();


  if($rowCount > 0) 
  {
    array_push($errors, "Already in cart"); 
  }
  else 
  {
    $query = "INSERT INTO `cart`(user_id, product_id, quantity) VALUES(?,?,?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$user_id,$product_id,$quantity]);
  
    $_SESSION['success']  = "New product successfully added!!";
  }
};

if (isset($_POST['update_cart'])) 
{
  $updated_quantity = $_POST['cart_quantity'];
  $update_id = $_POST['cart_id'];


  $query = "UPDATE cart SET quantity = '$updated_quantity' WHERE id = '$update_id'";

  $_SESSION['success']  = "New product successfully added!!";
};


if (isset($_GET['remove']))
{
  $remove_id = $_GET['remove'];
  $query = "DELETE FROM cart WHERE id = '$remove_id'";
  header('location:index.php');
};
  
if (isset($_GET['delete_all']))
{
  $query = "DELETE FROM cart WHERE user_id = '$user_id'";
  header('location:index.php');
};

?>
