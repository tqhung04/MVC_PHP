<?php 
	define( 'BASE_URL', 'http://mvc.local' );
	define( 'BASE_PATH', dirname(__FILE__) );
	define( 'PATH_ASSETS', BASE_PATH . '/assets' );
	define( 'PATH_SYSTEM', BASE_PATH . '/system' );
	define( 'PATH_ADMIN', BASE_PATH . '/admin' );

	require( PATH_SYSTEM . '/config/config.php' );
	include_once( PATH_SYSTEM . '/core/Base_Common.php' );
	include_once( PATH_SYSTEM . '/config/pagination.php' );

	Load();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Index</title>
</head>
<body>
	<a href="http://mvc.local?p=admin">Go to Admin</a>
</body>
</html>