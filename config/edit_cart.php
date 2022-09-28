<?php 
// session_start();

// connect to the database
require_once('db_connect.php');
$pdo = pdo_connect_mysql();


if(isset($_POST['add_cart'])){
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

?>
