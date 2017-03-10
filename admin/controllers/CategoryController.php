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

		// Search
		if ( isset($_GET['search']) ) {
			$categories = parent::search_base();
		}

		include PATH_ADMIN . '/views/Categories/index.php';
	}

	public function add () {
		
		if ( isset($_POST['create']) ) {
			if ( !empty($_POST['categoryName']) ) {
				$_SESSION['errMsg'] = '';
				$categoryName = $_POST['categoryName'];
				$categoryActive = empty( $_POST['productActive'] ) ? 0 : $_POST['categoryActive'];
				$check = Category::checkExist('categories', $categoryName);
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
		}
		include PATH_ADMIN . '/views/Categories/edit.php';
	}
}