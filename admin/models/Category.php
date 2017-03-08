<?php
class Category extends FT_Model {
	function __construct () {

	}

	public function getAllCategories () {
		$sql = 'SELECT * FROM categories ORDER BY id ASC';
		$stmt = parent::connect()->prepare($sql);
		$stmt -> execute();
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $data;
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

}