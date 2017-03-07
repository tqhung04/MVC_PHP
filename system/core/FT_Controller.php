<?php
class FT_Controller {
	public function __construct () {

		require_once PATH_SYSTEM . '/core/loader/FT_View_Loader.php';
		$this->view = new FT_View_Loader();
	}
}