<?php
function pdo_connect_mysql2()
{
	$DATABASE_HOST = 'localhost';
	$DATABASE_USER = 'root';
	$DATABASE_PASS = '';
	$DATABASE_NAME = 'brimstone';
	try {
		return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
	} catch (PDOException $exception) {
		// If connection error, stops script and displays error.
		exit('Failed to connect to database!' . $exception->getMessage());
	}
}

function pdo_connect_mysql()
{
	//Get Heroku ClearDB connection information
	$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
  $cleardb_server = $cleardb_url["host"];
  $cleardb_username = $cleardb_url["user"];
  $cleardb_password = $cleardb_url["pass"];
  $cleardb_db = substr($cleardb_url["path"],1);
  $active_group = 'default';
  $query_builder = TRUE;
  // Connect to DB
  $conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
	return $conn;
}
?>