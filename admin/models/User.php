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

	function getAllUser () {
		$pagination = new Pagination;
		$pagination->tblName = 'users';
		$pagination->current_page = isset($_GET['page']) ? $_GET['page'] : 1;
		$users = $pagination->listPages('users');
		$totalPages = $pagination->totalPages();
		return array(
			'users' => $users,
			'totalPages' => $totalPages
		);
	}

	function addUser ($userName, $userEmail, $userPwd, $userImg, $userActive) {
		try {
			$stmt = parent::connect()->prepare('
				INSERT INTO 
				users (username, email, password, avatar, active) 
				VALUES (:username, :email, :password, :avatar, :active)');
			$stmt->execute(array(
				':username' => $userName,
				':email' => $userEmail,
				':password' => $userImg,
				':avatar' => $userPwd,
				':active' => $userActive
			));

			return true;
		} catch (Exception $e) {
			echo "<br>" . $e->getMessage();
			return false;
		}
	}

	function updateUser ($id, $userName, $userEmail, $userPwd, $userImg, $userActive) {
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
				':username' => $userName,
				':email' => $userEmail,
				':password' => $userPwd,
				':avatar' => $userImg,
				':active' => $userActive,
				':id' => $id,
			));
			return true;
		} catch (Exception $e) {
			echo "<br>" . $e->getMessage();
			return false;
		}
	}

	function getUser ($id) {
		$stmt = parent::connect()->prepare('SELECT * FROM users WHERE id = :id');
		$stmt->execute(array(
			':id' => $id
		));
		return $data = $stmt->fetch(PDO::FETCH_ASSOC);
	}
}