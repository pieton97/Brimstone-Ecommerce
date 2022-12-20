<?php
function pdo_connect_mysql()
{
	// $DATABASE_HOST = 'localhost';
	// $DATABASE_USER = 'root';
	// $DATABASE_PASS = '';
	// $DATABASE_NAME = 'brimstone';
	$DATABASE_HOST = 'us-cdbr-east-06.cleardb.net';
	$DATABASE_USER = 'b8cc149d67668a';
	$DATABASE_PASS = '67f2ea24';
	$DATABASE_NAME = 'heroku_6fa303fc5bb9939';
	try {
		return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
	} catch (PDOException $exception) {
		// If connection error, stops script and displays error.
		exit('Failed to connect to database!' . $exception->getMessage());
	}
}

// function pdo_connect_mysql2()
// {
// 	$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
//   $cleardb_server = $cleardb_url["host"];
//   $cleardb_username = $cleardb_url["user"];
//   $cleardb_password = $cleardb_url["pass"];
//   $cleardb_db = substr($cleardb_url["path"],1);
//   $active_group = 'default';
//   $query_builder = TRUE;
//   $conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
// 	return $conn;
// }
?>