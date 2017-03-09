<?php
include_once PATH_ADMIN . '/models/Product.php';
include_once PATH_ADMIN . '/models/Category.php';

class ProductController extends FT_Controller {
	function __construct () {

	}

	function index () {
		$products = Product::getAllProducts();
		include PATH_ADMIN . '/views/Products/index.php';
	}

	function edit () {
		
		if ( isset($_GET['id']) ) {
			$id = $_GET['id'];
			$data = Product::getProduct($id);
			$categories = Category::getAllCategories();
			$category = Category::getNameById($data['categories_id']);

			if ( isset($_POST['update']) ) {

				if ( !empty($_POST['productName']) && !empty($_POST['productPrice']) && !empty($_POST['productCategory']) ) {

					$productName = $_POST['productName'];
					$productPrice = $_POST['productPrice'];
					$productCategory = $_POST['productCategory'];
					$productActive = $_POST['productActive'];

					// Check product's name
					$checkProductName = Product::checkExistProductName($productName);
					if ( $checkProductName == 1 && $productName != $data['name'] ) {
						// Product is Exist
						$_SESSION['errMsg'] = "Product already exists.";
					} else {
						// Check price
						if ( !is_numeric($productPrice) ) {
							$_SESSION['errMsg'] = "Price must be a number.";
						} else if ( $productPrice < 0 ) {
							$_SESSION['errMsg'] = "Price must be positive.";
						} else {
							$_SESSION['errMsg'] = '';
							// Check upload file
							if ( is_uploaded_file($_FILES['productImg']['tmp_name']) ) {
								move_uploaded_file($_FILES['productImg']['tmp_name'], PATH_ASSETS . '/upload/' . $_FILES['productImg']['name']);
								$oldname = PATH_ASSETS . '/upload/' . $_FILES['productImg']['name'];
								$newname = PATH_ASSETS . '/upload/' . $productName . '.png';
								rename($oldname , $newname);
								$productImg = '/assets/upload/' . $productName . '.png';
							} else {
								$productImg = $data['image'];
							}

							// Check description
							$productDescription = empty( $_POST['productDescription'] ) ? $data['description'] : $_POST['productDescription'];

							$productCategoryId = Category::getIdByName($productCategory);

							// echo $productName, $productPrice, $productDescription, $productImg, $productCategoryId, 'active: ' . $productActive;
							$update = Product::updateProduct($id, $productName, $productPrice, $productDescription, $productImg, $productCategoryId, $productActive);

							if ( $update == 1) {
								header( 'Location: ' . BASE_URL . '?p=admin&c=product');
							} else {
								$_SESSION['errMsg'] = 'Can not update product.';
							}
						}
					}
				} else {
					$_SESSION['errMsg'] = "Name, Price and Category are required.";
				}
			}
		}

		include PATH_ADMIN . '/views/Products/edit.php';
	}

	function add () {
		$categories = Category::getAllCategories();

		if ( isset($_POST['create']) ) {

			if ( !empty($_POST['productName']) && !empty($_POST['productPrice']) && !empty($_POST['productCategory']) ) {

				$productName = $_POST['productName'];
				$productPrice = $_POST['productPrice'];
				$productCategory = $_POST['productCategory'];

				// Check product's name
				$checkProductName = Product::checkExistProductName($productName);
				if ( $checkProductName == 1 ) {
					// Product is Exist
					$_SESSION['errMsg'] = "Product already exists.";
				} else {
					// Check price
					if ( !is_numeric($productPrice) ) {
						$_SESSION['errMsg'] = "Price must be a number.";
					} else if ( $productPrice < 0 ) {
						$_SESSION['errMsg'] = "Price must be positive.";
					} else {
						$_SESSION['errMsg'] = '';
						// Check upload file
						if ( is_uploaded_file($_FILES['productImg']['tmp_name']) ) {
							move_uploaded_file($_FILES['productImg']['tmp_name'], PATH_ASSETS . '/upload/' . $_FILES['productImg']['name']);
							$oldname = PATH_ASSETS . '/upload/' . $_FILES['productImg']['name'];
				            $newname = PATH_ASSETS . '/upload/' . $productName . '.png';
				            rename($oldname , $newname);
							$productImg = '/assets/upload/' . $productName . '.png';
						} else {
							$productImg = '';
						}

						// Check description
						$productDescription = empty( $_POST['productDescription'] ) ? '' : $_POST['productDescription'];
						// Check active
						$productActive = empty( $_POST['productActive'] ) ? 0 : $_POST['productActive'];

						// echo $productName, $productPrice, $productDescription, $productImg, $productCategory;
						$productCategoryId = Category::getIdByName($productCategory);
						$add = Product::addProduct($productName, $productPrice, $productDescription, $productImg, $productCategoryId, $productActive);
						if ( $add == 1 ) {
							header( 'Location: ' . BASE_URL . '?p=admin&c=product');
						} else {
							$_SESSION['errMsg'] = 'Can not add new product.';
						}
					}
				}
			} else {
				$_SESSION['errMsg'] = "Name, Price and Category are required.";
			}
		}

		include PATH_ADMIN . '/views/Products/add.php';
	}

}