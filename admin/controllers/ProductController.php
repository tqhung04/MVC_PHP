<?php
include_once PATH_ADMIN . '/models/Product.php';
class ProductController extends FT_Controller {
	function __construct () {

	}

	function index () {
		$data = Product::getAllProducts();
		include PATH_ADMIN . '/views/Products/index.php';
	}

	function edit () {
		include PATH_ADMIN . '/views/Products/edit.php';
	}
}