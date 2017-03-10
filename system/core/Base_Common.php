<?php
if( !isset($_SESSION) ) { 
    session_start(); 
} 

function Load () {

	include_once PATH_SYSTEM . '/config/dbconnect.php';

	// Admin
	$admin_config = include_once PATH_ADMIN . '/config/init.php';


	if ( isset($_GET['p']) && $_GET['p'] == 'admin' ) {
		
		// Check Login
		if ( empty($_COOKIE['username']) && empty($_SESSION['username'])) {
			$controller = $admin_config['login_controller'];
		} else {
			include PATH_ADMIN . '/views/Template/header.php';
			include PATH_ADMIN . '/views/Template/menu_left.php';
			$controller = empty( $_GET['c'] ) ? $admin_config['default_controller'] : $_GET['c'];
		}

		$action = empty( $_GET['a'] ) ? $admin_config['default_action'] : $_GET['a'];
		$controller = ucfirst(strtolower($controller)) . 'Controller';

		// Check Controller
		if ( !file_exists(PATH_ADMIN . '/controllers/' . $controller . '.php') ) {
			die ( 'File ' . $controller . '.php no exists.' );
		}
		
		include_once PATH_SYSTEM . '/core/Base_Model.php';
		include_once PATH_SYSTEM . '/core/Base_Controller.php';
		require_once PATH_ADMIN . '/controllers/' . $controller . '.php';

		// Check Class
		if ( !class_exists($controller) ) {
			die ( 'Class ' . $controller . ' no exists.' );
		}

		$controllerObj = new $controller();

		// Check Method
		if ( !method_exists($controllerObj, $action) ) {
			die ( 'Action ' . $action . ' no exists.' );
		}

		// Run App
		$controllerObj -> {$action}();

	} else if ( isset($_GET['p']) && $_GET['p'] != 'admin' ) {
		echo '404 ERROR';

	} else if ( empty($_GET['p']) ) {
		echo 'HOME';
	}
}