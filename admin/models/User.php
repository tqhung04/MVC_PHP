<?php
class User extends dbconnect {
	function __construct () {

	}

	function login ($username, $password) {
		$stmt = parent::connect()->prepare('SELECT * FROM users WHERE username = :username and password = :password');
		$stmt->execute(array(
			':username' => $username,
			':password' => $password
		));
		if ($stmt->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}
	function getAllUser () {}
	function searchUser () {}
}