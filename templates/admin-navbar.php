<ul class="admin-navbar" style="display: flex; gap: 10px;">
	<?php
	$activePage = basename($_SERVER['PHP_SELF'], ".php");
	$navbar = array(
		'home' 					=> array('name' => 'Home', 'path' => '/brimstone/admin/admin_home.php'),
		'products' 			=> array('name' => 'Products', 'path' => '/brimstone/admin/admin_products.php'),
		'users'					=> array('name' => 'Users', 'path' => '/brimstone/admin/admin_users.php'),
		'placed orders'	=> array('name' => 'Orders', 'path' => '/brimstone/admin/admin_orders.php'),
	);

	foreach ($navbar as $tabName => $tab) {
		print '<li ' . (($activePage === $tabName) ? ' class="active" ' : '') . '>
			<a href="' . $tab['path'] . '">' . $tab['name'] . '</a></li>';
	}
	?>
</ul>