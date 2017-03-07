<?php

class ProductController extends FT_Controller {
	function __construct () {

	}

	function index () {
		include PATH_ADMIN . '/views/Products/index.php';
	}
}