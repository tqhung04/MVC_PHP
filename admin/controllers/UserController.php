<?php
include_once PATH_ADMIN . '/models/User.php';
class UserController extends Base_Controller {
	protected $errMsg;
	protected $messages;
	protected $user;

	function __construct () {
		parent::__construct();
		$this->errMsg = array(
			'add' => 'Can not add new user.',
			'update' => 'Can not update user.',
			'username_exists' => 'Username already exists.',
			'username_regex' => 'Username is a string only contains letters, number and dash.',
			'username_required' => 'Username is required.',
			'email_exists' => 'Email already exists.',
			'email_regex' => 'Email must be a email form.',
			'email_required' => 'Email is required.',
			'password_required' => 'Password is required.',
			'password_regex' => 'Password must be more 8 characters .',
		);
		$this->messages = [];
	}
	public function create () {
		if ( isset($_POST['create']) ) {
			$data = $this->validate();
			if ( !empty($data) ) {
				$check = User::addUser($data);
				$this->checkValidate($check);
			}
		}
		include PATH_ADMIN . '/views/zTemplate/user.php';
	}
	public function update () {
		if ( isset($_GET['id']) ) {
			$this->user = User::getOneRow($_GET['id'], 'users');
			if ( isset($_POST['update']) ) {
				$data = $this->validate();
				if ( !empty($data) ) {
					$check = User::updateUser($data);
					$this->checkValidate($check);
				}
			}
		}
		include PATH_ADMIN . '/views/zTemplate/user.php';
	}

	public function validate () {

		$result = array(
			'validate_username' => $this->validate_username(),
			'validate_email' => $this->validate_email(),
			'validate_password' => $this->validate_password(),
			'validate_img' => $this->validate_img(),
			'validate_active' => $this->validate_active(),
		);
		$data = [];
		$check = 0;
		print_r($result);
		foreach ($result as $key => $value) {
			if ( !is_array($value) ) {
				array_push($this->messages, $value);
			} else {
				array_push($data, $value['data']);
				$check += 1;
			}
		}
		if ( $check == sizeof($result) ) {
			return $data;
		}
	}

	public function validate_username () {
		if ( empty($_POST['userName']) ) {
			return $this->errMsg['username_required'];
		} else {
			$userName = $_POST['userName'];
			$pattern = "/^[A-Za-z0-9 _'. ]*[A-Za-z0-9][A-Za-z0-9 _'.]*$/";
			if ( preg_match($pattern, $userName) ) {
				$checkUserName = User::checkExist('users', 'username', $userName);
				if ( $checkUserName == 1 && isset($this->user) && $userName == $this->user['username'] ) {
					return array(
						'data' => $userName,
					);
				} else if ( $checkUserName == 1 ) {
					return $this->errMsg['username_exists'];
				}
			} else {
				return $this->errMsg['username_regex'];
			}
		}

		return array(
			'data' => $userName,
		);
	}

	public function validate_email () {
		if ( empty($_POST['userEmail']) ) {
			return $this->errMsg['email_required'];
		} else {
			$userEmail = $_POST['userEmail'];
			if ( filter_var($userEmail, FILTER_VALIDATE_EMAIL) ) {
				$checkUserEmail = User::checkExist('users', 'email', $userEmail);
				if ( $checkUserEmail == 1 && isset($this->user) && $userEmail == $this->user['email'] ) {
					return array(
						'data' => $userEmail,
					);
				} else if ( $checkUserEmail == 1 ) {
					return $this->errMsg['email_exists'];
				}
			} else {
				return $this->errMsg['email_regex'];
			}
		}

		return array(
			'data' => $userEmail,
		);
	}

	public function validate_password () {
		if ( empty($_POST['userPassword']) ) {
			return $this->errMsg['password_required'];
		} else {
			$userPassword = $_POST['userPassword'];
			$pattern = '/^.{8,}$/';
			if ( preg_match($pattern, $userPassword) ) {
				return array(
					'data' => $userPassword,
				);
			} else {
				return $this->errMsg['password_regex'];
			}
		}
	}

	public function validate_img() {
		if ( is_uploaded_file($_FILES['userImg']['tmp_name']) && isset($this->validate_username()['data']) ) {
			$userName = $this->validate_username()['data'];
			move_uploaded_file($_FILES['userImg']['tmp_name'], PATH_ASSETS . '/upload/' . $_FILES['userImg']['name']);
			$oldname = PATH_ASSETS . '/upload/' . $_FILES['userImg']['name'];
			$newname = PATH_ASSETS . '/upload/' . $userName . '.png';
			rename($oldname , $newname);
			return array(
				'data' => '/assets/upload/' . $userName . '.png',
			);
		} else {
			return array(
				'data' => '',
			);
		}
	}

	public function validate_active () {
		$userActive = empty( $_POST['userActive'] ) ? 0 : $_POST['userActive'];
		return array(
			'data' => $userActive,
		);
	}
}