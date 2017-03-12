<?php
include_once PATH_ADMIN . '/models/Category.php';

class CategoryController extends Base_Controller {
	function __construct () {
		parent::__construct();
	}

	public function index () {
		
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

		// Search
		if ( isset($_GET['search']) ) {
			$result = parent::search_base();
			$total = $result['total'];
			if ( isset($result['data']) )
				$categories = $result['data'];
			else
				$categories = '';
		}

		include PATH_ADMIN . '/views/Categories/index.php';
	}

	public function add () {
		
		if ( isset($_POST['create']) ) {
			if ( !empty($_POST['categoryName']) ) {
				$_SESSION['errMsg'] = '';
				$categoryName = $_POST['categoryName'];
				$categoryActive = empty( $_POST['productActive'] ) ? 0 : $_POST['categoryActive'];
				$check = Category::checkExist('categories', 'name', $categoryName);
				if ( $check == 1 ) {
					$_SESSION['errMsg'] = 'Category already exists.';
				} else {
					$add = Category::addCategory($categoryName, $categoryActive);
					if ( $add == 1 ) {
						header( 'Location: ' . BASE_URL . '?p=admin&c=category');
					} else {
						$_SESSION['errMsg'] = 'Can not add new category.';
					}
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
			if ( !empty($_POST['categoryName']) ) {
				$categoryName = $_POST['categoryName'];
				$categoryActive = $_POST['categoryActive'];
				$checkCategoryName = Category::checkExist('categories', 'name', $categoryName);
				if ( $checkCategoryName == 1  && $categoryName != $data['name'] ) {
					$_SESSION['errMsg'] = "Category already exists.";
				} else {
					$_SESSION['errMsg'] = '';
					$update = Category::editCategory($id, $categoryName, $categoryActive);
					if ( $update == 1) {
						header( 'Location: ' . BASE_URL . '?p=admin&c=category');
					} else {
						$_SESSION['errMsg'] = 'Can not update category.';
					}
				}
			}
		}
		include PATH_ADMIN . '/views/Categories/edit.php';
	}
}