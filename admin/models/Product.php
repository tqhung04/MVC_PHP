<?php
class Product extends dbconnect {
	function __construct () {

	}

	public function getAllProducts () {
		$sql = 'SELECT * FROM products ORDER BY id ASC';
		$stmt = parent::connect()->prepare($sql);
		$stmt -> execute();
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $data;
	}
	function getAllUser () {}
	function searchUser () {}
}