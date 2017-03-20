<?php
class User extends Base_Model {
	function __construct () {
	}
	function login ($username, $password) {
		$stmt = parent::connect()->prepare('SELECT * FROM users WHERE username = :username and password = :password');
		$stmt->execute(array(
			':username' => $username,
			':password' => $password
		));
		$data = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($stmt->rowCount() > 0) {
			return array(
				'status' => 0,
				'message' => 'Login successed',
				'data' => [
					'id' => $data['id'],
					'avatar' => $data['avatar'],
				],	
			);
		} else {
			return array(
				'status' => 1,
				'message' => 'Login failed',
			);
		}
	}
	function addUser ($data) {
		try {
			$stmt = parent::connect()->prepare('
				INSERT INTO 
				users (username, email, password, avatar, active) 
				VALUES (:username, :email, :password, :avatar, :active)');
			$stmt->execute(array(
				':username' => $data['0'],
				':email' => $data['1'],
				':password' => $data['2'],
				':avatar' => $data['3'],
				':active' => $data['4'],
			));

			return true;
		} catch (Exception $e) {
			echo "<br>" . $e->getMessage();
			return false;
		}
	}
	function updateUser ($data) {
		try {
			$stmt = parent::connect()->prepare('
				UPDATE users 
				SET username=:username,
					email=:email, 
					password=:password, 
					avatar=:avatar, 
					active=:active
				WHERE id=:id');
			$stmt->execute(array(
				':username' => $data['0'],
				':email' => $data['1'],
				':password' => $data['2'],
				':avatar' => $data['3'],
				':active' => $data['4'],
				':id' => $_GET['id'],
			));
			return true;
		} catch (Exception $e) {
			echo "<br>" . $e->getMessage();
			return false;
		}
	}
}