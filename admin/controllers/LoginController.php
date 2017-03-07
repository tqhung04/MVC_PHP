<?php
include_once PATH_ADMIN . '/models/User.php';

class LoginController extends FT_Controller {
	function __construct () {

	}

	function login () {
		if ( isset($_POST['btnLogin']) ) {
			if ( isset($_POST['inputUsername']) && isset($_POST['inputPassword']) ) {
				$username = $_POST['inputUsername'];
				$password = $_POST['inputPassword'];

				$check = User::login($username, $password);
				if ( $check == 1 ) {
					setcookie('username', $username, time() + (86400 * 30), "/");
					setcookie('password', $password, time() + (86400 * 30), "/");					
				} else {
					echo "Login Failed";
				}
			}
			else {
				// Nhap chua du username va password
			}
		}
	}

	function index () {
		include PATH_ADMIN . '/views/Auth/login.php';
		$this->login();
	}
}