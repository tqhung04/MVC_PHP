<?php
include_once PATH_ADMIN . '/models/Category.php';

class CategoryController extends Base_Controller {
	protected $data;
	protected $category;
	protected $messages;

	function __construct () {
		parent::__construct();
		$this->errMsg = array(
			'add' => 'Can not add new category.',
			'update' => 'Can not update category.',
			'exists' => 'Category already exists.',
			'name_required' => 'Name is required.'
		);
		$this->messages = [];
	}

	public function create () {
		if ( isset($_POST['create']) ) {
			$data = $this->validate();
			if ( !empty($data) ) {
				$check = Category::addCategory($data);
				$this->checkValidate($check);
			}
		}
		include PATH_ADMIN . '/views/zTemplate/category.php';
	}

	public function update () {
		if ( isset($_GET['id']) ) {
			$this->category = Category::getOneRow($_GET['id'], 'categories');
			if ( isset($_POST['update']) ) {
				$data = $this->validate();
				if ( !empty($data) ) {
					$check = Category::updateCategory($data);
					$this->checkValidate($check);
				}
			}
		}
		include PATH_ADMIN . '/views/zTemplate/category.php';
	}

	public function validate () {
		$result = array(
			'validate_name' => $this->validate_name(),
			'validate_active' => $this->validate_active(),
		);
		$data = [];
		$check = 0;
		foreach ($result as $key => $value) {
			if ( !is_array($value) ) {
				array_push($this->messages, $value);
			} else {
				array_push($data, $value['data']);
				$check += 1;
			}
		}
		if ( $check == sizeof($result) ) {
			print_r( $data );
			return $data;
		}
	}

	public function validate_name () {
		if ( empty($_POST['categoryName']) ) {
			return $this->errMsg['name_required'];
		} else {
			$categoryName = $_POST['categoryName'];
			$checkCategoryName = Category::checkExist('categories', 'name', $categoryName);
			if ( $checkCategoryName == 1 && isset($this->category) && $categoryName == $this->category['name'] ) {
				return array(
					'data' => $categoryName,
				);
			} else if ( $checkCategoryName == 1 ) {
				return $this->errMsg['exists'];
			}
		}

		return array(
			'data' => $categoryName,
		);
	}

	public function validate_active () {
		$categoryActive = empty( $_POST['categoryActive'] ) ? 0 : $_POST['categoryActive'];
		return array(
			'data' => $categoryActive,
		);
	}
}