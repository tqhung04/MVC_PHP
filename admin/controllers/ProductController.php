<?php
include_once PATH_ADMIN . '/models/Product.php';
include_once PATH_ADMIN . '/models/Category.php';
class ProductController extends Base_Controller {
	protected $errMsg;
	protected $messages;
	protected $product;
	protected $categories;

	public function __construct () {
		parent::__construct();
		$this->errMsg = array(
			'add' => 'Can not add new product.',
			'update' => 'Can not update product.',
			'exists' => 'Product already exists.',
			'required' => 'Name, Price and Category are required.',
			'price_number' => 'Price must be a number.',
			'price_positive' => 'Price must be positive.',
			'name_required' => 'Name is required.',
			'price_required' => 'Price is required.',
			'category_required' => 'Category is required.',
		);
		$this->messages = [];
		$this->categories = Category::getAllCategoriesNoPagi();
	}
	
	public function update () {
		if ( isset($_GET['id']) ) {
			$this->product = Product::getOneRow($_GET['id'], 'products');
			$current_category = Category::getNameById($this->product['categories_id']);
			if ( isset($_POST['update']) ) {
				$data = $this->validate();
				if ( !empty($data) ) {
					$check = Product::updateProduct($data);
					$this->checkValidate($check);
				}
			}
		}

		include PATH_ADMIN . '/views/zTemplate/product.php';
	}

	public function create () {
		if ( isset($_POST['create']) ) {
			$data = $this->validate();
			if ( !empty($data) ) {
				$check = Product::addProduct($data);
				$this->checkValidate($check);
			}
		}
		include PATH_ADMIN . '/views/zTemplate/product.php';
	}

	public function validate () {

		$result = array(
			'validate_name' => $this->validate_name(),
			'validate_price' => $this->validate_price(),
			'validate_description' => $this->validate_description(),
			'validate_img' => $this->validate_img(),
			'validate_categoryId' => $this->validate_categoryId(),
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
			return $data;
		}
	}

	public function validate_name () {
		if ( empty($_POST['productName']) ) {
			return $this->errMsg['name_required'];
		} else {
			$productName = $_POST['productName'];
			$checkProductName = Product::checkExist('products', 'name', $productName);
			if ( $checkProductName == 1 && isset($this->product) && $productName == $this->product['name'] ) {
				return array(
					'data' => $productName,
				);
			} else if ( $checkProductName == 1 ) {
				return $this->errMsg['exists'];
			}
		}

		return array(
			'data' => $productName,
		);
	}

	public function validate_price () {
		if ( empty($_POST['productPrice']) ) {
			return $this->errMsg['price_required'];
		} else {
			$productPrice = $_POST['productPrice'];
			if ( !is_numeric($productPrice) ) {
				return $this->errMsg['price_number'];
			} else if ( $productPrice < 0 ) {
				return $this->errMsg['price_positive'];
			}
		}
		return array(
			'data' => $productPrice,
		);
	}

	public function validate_categoryId () {
		if ( empty($_POST['productCategory']) ) {
			return $this->errMsg['category_required'];
		} else {
			$productCategory = $_POST['productCategory'];
			$productCategoryId = Category::getIdByName($productCategory);
			return array(
				'data' => $productCategoryId,
			);
		}
	}

	public function validate_img () {
		if ( is_uploaded_file($_FILES['productImg']['tmp_name']) && isset($this->validate_name()['data']) ) {
			$productName = $this->validate_name()['data'];
			move_uploaded_file($_FILES['productImg']['tmp_name'], PATH_ASSETS . '/upload/' . $_FILES['productImg']['name']);
			$oldname = PATH_ASSETS . '/upload/' . $_FILES['productImg']['name'];
			$newname = PATH_ASSETS . '/upload/' . $productName . '.png';
			rename($oldname , $newname);
			return array(
				'data' => '/assets/upload/' . $productName . '.png',
			);
		} else {
			return array(
				'data' => '',
			);
		}
	}

	public function validate_description () {
		$productDescription = empty( $_POST['productDescription'] ) ? '' : $_POST['productDescription'];
		return array(
			'data' => $productDescription,
		);
	}

	public function validate_active () {
		$productActive = empty( $_POST['productActive'] ) ? 0 : $_POST['productActive'];
		return array(
			'data' => $productActive,
		);
	}
}