<?php
class Product extends FT_Model {
	function __construct () {

	}

	public function getAllProducts () {
		$sql = 'SELECT * FROM products ORDER BY id DESC';
		$stmt = parent::connect()->prepare($sql);
		$stmt -> execute();
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $data;
	}
	
	public function checkExistProductName ($name) {
		$stmt = parent::connect()->prepare('SELECT * FROM products WHERE name = :name');
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

	public function addProduct ($name, $price, $description, $image, $categories_id) {
		try {
			$stmt = parent::connect()->prepare('INSERT INTO 
												products (name, price, description, image, categories_id) 
												VALUES (:name, :price, :description, :image, :categories_id)');
			$stmt->execute(array(
				':name' => $name,
				':price' => $price,
				':description' => $description,
				':image' => $image,
				':categories_id' => $categories_id,
			));
		} catch (Exception $e) {
			echo "<br>" . $e->getMessage();
		}
		
	}

}