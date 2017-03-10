<?php
class Category extends Base_Model {
	function __construct () {

	}

	public function getAllCategories () {
		$pagination = new Pagination;
		$pagination->tblName = 'categories';
		$pagination->current_page = isset($_GET['page']) ? $_GET['page'] : 1;
		$categories = $pagination->listPages('categories');
		$totalPages = $pagination->totalPages();
		return array(
			'categories' => $categories,
			'totalPages' => $totalPages
		);
	}

	public function getCategory ($id) {
		$stmt = parent::connect()->prepare('SELECT * FROM categories WHERE id = :id');
		$stmt->execute(array(
			':id' => $id
		));
		return $data = $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function getIdByName ($categoryName) {
		$stmt = parent::connect()->prepare('SELECT id FROM categories WHERE name = :categoryName');
		$stmt->execute(array(
			':categoryName' => $categoryName
		));
		$data = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($stmt->rowCount() > 0) {
			return (int) $data['id'];
		} else {
			return false;
		}
	}

	public function getNameById ($id) {
		$stmt = parent::connect()->prepare('SELECT name FROM categories WHERE id = :categoryId');
		$stmt->execute(array(
			':categoryId' => (int) $id
		));
		$data = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if ($stmt->rowCount() > 0) {
			return $data['name'];
		} else {
			return false;
		}
	}

	public function checkExistCategoryName ($name) {
		$stmt = parent::connect()->prepare('SELECT * FROM categories WHERE name = :name');
		$stmt->execute(array(
			':name' => $name
			));
		$data = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($stmt->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}

}