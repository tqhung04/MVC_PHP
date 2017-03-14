<?php
class Base_Model extends dbconnect {
	protected $c;
	public function __construct () {
		$this->c = $_GET['c'];
	}
	public function getAllData () {
		$pagination = new Pagination;
		if ( $_GET['c'] == 'category' ) {
			$tblName = 'categories';
		} else {
			$tblName = $_GET['c'] . 's';
		}
			$pagination->tblName = $tblName;
		$pagination->current_page = isset($_GET['page']) ? $_GET['page'] : 1;
		$data = $pagination->listPages($tblName);
		$totalPages = $pagination->totalPages();
		return array(
			'data' => $data,
			'totalPages' => $totalPages
		);
	}
	public function getOneRow ($id, $table) {
		$sql = 'SELECT * FROM ' . $table . ' WHERE id=' . $id;
		$stmt = parent::connect()->prepare($sql);
		$stmt->execute();
		return $data = $stmt->fetch(PDO::FETCH_ASSOC);
	}
	public function checkExist ($nameTbl, $nameField, $value) {
		$sql = 'SELECT * FROM ' . $nameTbl . ' WHERE ' . $nameField . ' = "' . $value . '"'; ;
		$stmt = parent::connect()->prepare($sql);
		$stmt->execute();
		$data = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($stmt->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function deactive ($id, $name) {
		try {
			if ($name == 'category') $name = 'categorie';
			$sql = 'UPDATE ' . $name . 's SET active = 1 WHERE id = ' . $id;
			$stmt = parent::connect()->prepare($sql);
			$stmt->execute();

			return true;
		} catch (Exception $e) {
			echo "<br>" . $e->getMessage();
			return false;
		}
	}
	public function active ($id, $name) {
		try {
			if ($name == 'category') $name = 'categorie';
			$sql = 'UPDATE ' . $name . 's SET active = 0 WHERE id = ' . $id;
			$stmt = parent::connect()->prepare($sql);
			$stmt->execute();

			return true;
		} catch (Exception $e) {
			echo "<br>" . $e->getMessage();
			return false;
		}
	}
	public function search ($model, $content) {
		try {
			if ($model == 'category') {
				$model = 'categorie';
			}
			$sql = 'SELECT * FROM ' . $model . 's WHERE name LIKE "%' . $content . '%"';
			if ( $model == 'user' ) {
				$sql = 'SELECT * FROM ' . $model . 's WHERE username LIKE "%' . $content . '%"';
			}
			
			$stmt = parent::connect()->prepare($sql);
			$stmt->execute();

			if ( $stmt->rowCount() > 0 ) {
				return array(
					'data' => $stmt->fetchAll(PDO::FETCH_ASSOC),
					'total' => $stmt->rowCount(),
				);
			}
			else {
				return array(
					'total' => $stmt->rowCount(),
				);
			}
		} catch (Exception $e) {
			echo "<br>" . $e->getMessage();
			return false;
		}
	}
	public function searchProductByPrice ($model, $content) {
		try {
			$sql = 'SELECT * FROM products WHERE price =' . $content;
			$stmt = parent::connect()->prepare($sql);
			$stmt->execute();

			if ( $stmt->rowCount() > 0 ) {
				return array(
					'data' => $stmt->fetchAll(PDO::FETCH_ASSOC),
					'total' => $stmt->rowCount(),
				);
			}
			else {
				return array(
					'total' => $stmt->rowCount(),
				);
			}
		} catch (Exception $e) {
			echo "<br>" . $e->getMessage();
			return false;
		}
	}
	public function searchProductByCategory ($mode, $content) {
		try {
			$sql = 'SELECT products.id, products.name, products.price, products.created_at, products.updated_at, products.active FROM products INNER JOIN categories ON products.categories_id = categories.id AND categories.name LIKE "%' . $content . '%"';
			$stmt = parent::connect()->prepare($sql);
			$stmt->execute();

			if ( $stmt->rowCount() > 0 ) {
				return array(
					'data' => $stmt->fetchAll(PDO::FETCH_ASSOC),
					'total' => $stmt->rowCount(),
				);
			}
			else {
				return array(
					'total' => $stmt->rowCount(),
				);
			}
		} catch (Exception $e) {
			echo "<br>" . $e->getMessage();
			return false;
		}
	}

}