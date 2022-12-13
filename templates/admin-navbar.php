<ul class="admin-navbar" style="display: flex; gap: 10px;">
	<?php
	$activePage = basename($_SERVER['PHP_SELF'], ".php");
	$navbar = array(
		'admin_home' 					=> array('name' => 'Home', 'path' => '/brimstone/admin/admin_home.php'),
		'admin_products' 			=> array('name' => 'Products', 'path' => '/brimstone/admin/admin_products.php'),
		'admin_users'					=> array('name' => 'Users', 'path' => '/brimstone/admin/admin_users.php'),
		'admin_orders'	=> array('name' => 'Orders', 'path' => '/brimstone/admin/admin_orders.php'),
		'admin_mailing_list'	=> array('name' => 'Mailing', 'path' => '/brimstone/admin/admin_mailing_list.php'),
	);

	foreach ($navbar as $tabName => $tab) {
		print '<li ' . (($activePage === $tabName) ? ' class="active" ' : '') . '>
			<a href="' . $tab['path'] . '">' . $tab['name'] . '</a></li>';
	}
	?>
</ul>