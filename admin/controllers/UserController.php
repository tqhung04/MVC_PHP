<?php
include_once PATH_ADMIN . '/models/User.php';

class UserController extends Base_Controller {
	function __construct () {
		parent::__construct();
	}

	public function index () {
		$data = User::getAllUser();
		$users = $data['users'];
		$totalPages = $data['totalPages'];
		$previous = $_GET['page'] - 1;
		$next = $_GET['page'] + 1;

		if ( isset($_POST['active']) ) {
			parent::active($_GET['c']);
		} else if ( isset($_POST['deactive']) ) {
			parent::deactive($_GET['c']);
		}
		
		// Search
		if ( isset($_GET['search']) ) {
			$result = parent::search_base();
			$total = $result['total'];
			if ( isset($result['data']) )
				$users = $result['data'];
			else
				$users = '';
		}
		
		include PATH_ADMIN . '/views/Users/index.php';
	}

	public function add () {
		if ( isset($_POST['create']) ) {
			if ( !empty($_POST['userName']) && !empty($_POST['userEmail']) && !empty($_POST['userPwd']) ) {
				$userName = $_POST['userName'];
				$userEmail = $_POST['userEmail'];
				$userPwd = $_POST['userPwd'];
				// Check username
				$checkUserName = User::checkExist('users', 'username', $userName);
				if ( $checkUserName == 1 ) {
					// User is Exist
					$_SESSION['errMsg'] = "Username already exists.";
				} else {
					// Check email
					$checkUserEmail = User::checkExist('users', 'email', $userEmail);
					if ( $checkUserEmail == 1 ) {
						$_SESSION['errMsg'] = "Email already exists.";
					} else {
						$_SESSION['errMsg'] = '';
						// Check upload file
						if ( is_uploaded_file($_FILES['userImg']['tmp_name']) ) {
							move_uploaded_file($_FILES['userImg']['tmp_name'], PATH_ASSETS . '/upload/' . $_FILES['userImg']['name']);
							$oldname = PATH_ASSETS . '/upload/' . $_FILES['userImg']['name'];
				            $newname = PATH_ASSETS . '/upload/' . $userName . '.png';
				            rename($oldname , $newname);
							$userImg = '/assets/upload/' . $userName . '.png';
						} else {
							$userImg = '';
						}
						// Check active
						$userActive = empty( $_POST['userActive'] ) ? 0 : $_POST['userActive'];
						// echo $userName, $userEmail, $userImg, $userActive;

						$add = User::addUser($userName, $userEmail, $userImg, $userPwd, $userActive);
						if ( $add == 1 ) {
							header( 'Location: ' . BASE_URL . '?p=admin&c=user');
						} else {
							$_SESSION['errMsg'] = 'Can not add new user.';
						}
					}
				}
			} else {
				$_SESSION['errMsg'] = "Username, Email and Password are required.";
			}
		}
		include PATH_ADMIN . '/views/Users/add.php';
	}

	public function edit () {
		if ( isset($_GET['id']) ) {
			$id = $_GET['id'];
			$data = User::getUser($id);	
			if ( isset($_POST['update']) ) {
				if ( !empty($_POST['userName']) && !empty($_POST['userEmail']) && !empty($_POST['userPwd']) ) {
					$userName = $_POST['userName'];
					$userEmail = $_POST['userEmail'];
					$userPwd = $_POST['userPwd'];
					$userActive = $_POST['userActive'];
					// Check username
					$checkUserName = User::checkExist('users', 'username', $userName);
					if ( $checkUserName == 1 && $userName != $data['username']) {
						// User is Exist
						$_SESSION['errMsg'] = "Username already exists.";
					} else {
						// Check email
						$checkUserEmail = User::checkExist('users', 'email', $userEmail);
						if ( $checkUserEmail == 1 && $userEmail != $data['email']) {
							$_SESSION['errMsg'] = "Email already exists.";
						} else {
							$_SESSION['errMsg'] = '';
							// Check upload file
							if ( is_uploaded_file($_FILES['userImg']['tmp_name']) ) {
								move_uploaded_file($_FILES['userImg']['tmp_name'], PATH_ASSETS . '/upload/' . $_FILES['userImg']['name']);
								$oldname = PATH_ASSETS . '/upload/' . $_FILES['userImg']['name'];
					            $newname = PATH_ASSETS . '/upload/' . $userName . '.png';
					            rename($oldname , $newname);
								$userImg = '/assets/upload/' . $userName . '.png';
							} else {
								$userImg = $data['image'];
							}
							echo $userName, $userEmail, $userPwd, $userImg, $userActive;
							$update = User::updateUser($id, $userName, $userEmail, $userPwd, $userImg, $userActive);
							if ( $update == 1 ) {
								$_SESSION['avatar'] = $userImg;
								header( 'Location: ' . BASE_URL . '?p=admin&c=user');
							} else {
								$_SESSION['errMsg'] = 'Can not add new user.';
							}
						}
					}
				} else {
					$_SESSION['errMsg'] = "Username, Email and Password are required.";
				}
			}
		}
		include PATH_ADMIN . '/views/Users/edit.php';
	}
}