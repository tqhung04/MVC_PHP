<?php
class Category extends dbconnect {
	function __construct () {

	}

	public function getAllCategories () {
		$sql = 'SELECT * FROM categories ORDER BY id ASC';
		$stmt = parent::connect()->prepare($sql);
		$stmt -> execute();
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $data;
	}

}