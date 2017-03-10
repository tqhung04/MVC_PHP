<?php
include_once PATH_ADMIN . '/models/Category.php';

class CategoryController extends Base_Controller {
	function __construct () {
		
	}

	public function index () {
		if ( !isset($_GET['page']) ) {
			$_GET['page'] = 1;
		}
		
		$data = Category::getAllCategories();
		$categories = $data['categories'];
		$totalPages = $data['totalPages'];
		$previous = $_GET['page'] - 1;
		$next = $_GET['page'] + 1;

		if ( isset($_POST['active']) ) {
			parent::active($_GET['c']);
		} else if ( isset($_POST['deactive']) ) {
			parent::deactive($_GET['c']);
		}

		include PATH_ADMIN . '/views/Categories/index.php';
	}

	public function add () {
		
		if ( isset($_POST['create']) ) {
			if ( isset($_POST['categoryName'])  && isset($_POST['categoryActive']) ) {
				$categoryName = $_POST['categoryName'];
				$categoryActive = $_POST['categoryActive'];

				$check = Category::checkExistCategoryName();
				if ( $check == 1 ) {
					$_SESSION['errMsg'] = 'Category already exists.';
				} else {
					echo $categoryName, $categoryActive;
				}
			} else {
				$_SESSION['errMsg'] = 'Name is required.';
			}
		}
		include PATH_ADMIN . '/views/Categories/add.php';
	}

	public function edit () {
		if ( isset($_GET['id']) ) {
			$id = $_GET['id'];
			$data = Category::getCategory($id);
		}
		include PATH_ADMIN . '/views/Categories/edit.php';
	}
}