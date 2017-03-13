<?php
include_once PATH_ADMIN . '/models/User.php';

class LoginController extends Base_Controller {
	function __construct () {

	}

	function index () {
		include PATH_ADMIN . '/views/Auth/login.php';
		$this->login();
	}

	function login () {
		if ( isset($_POST['btnLogin']) ) {
			if ( !empty($_POST['inputUsername']) && !empty($_POST['inputPassword']) ) {
				$username = $_POST['inputUsername'];
				$password = $_POST['inputPassword'];

				$check = User::login($username, $password);
				if ( $check['status'] == 0) {
					$_SESSION['errMsg'] = '';
					setcookie('id', $check['data']['id'], time() + (86400 * 30), "/");
					setcookie('avatar', $check['data']['avatar'], time() + (86400 * 30), "/");
					if( $_POST["cbRemember"] == 1 ) {
						setcookie('username', $username, time() + (86400 * 30), "/");
						setcookie('password', $password, time() + (86400 * 30), "/");
					}
					$_SESSION['username'] = $username;
					header( 'Location: ' . BASE_URL . '?p=admin');
				} else {
					$_SESSION['errMsg'] = "User & password doesn't match.";
				}
			}
			else {
				//
			}
		}
	}

	function logout () {
		setcookie('username', '', time() - (86400 * 30) );
		setcookie('password', '', time() - (86400 * 30) );
		setcookie('id', $check['data']['id'], time() - (86400 * 30), "/");
		setcookie('avatar', $check['data']['avatar'], time() - (86400 * 30), "/");
		unset($_SESSION["username"]);
		header( 'Location: ' . BASE_URL . '?p=admin');
	}

	
}