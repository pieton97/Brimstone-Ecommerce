<?php 
echo getcwd() . "<br>";
chdir('C://xampp/htdocs/brimstone');
echo getcwd() . "<br>";

// tells you if a user is logged in or not
function isLoggedIn()
{
	if (isset($_SESSION['user'])) {
		return true;
	}else{
		return false;
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

