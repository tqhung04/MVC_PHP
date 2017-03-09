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

	public function getProduct ($id) {
		$stmt = parent::connect()->prepare('SELECT * FROM products WHERE id = :id');
		$stmt->execute(array(
			':id' => $id
			));
		return $data = $stmt->fetch(PDO::FETCH_ASSOC);

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

	public function addProduct ($name, $price, $description, $image, $categories_id, $productActive) {
		try {
			$stmt = parent::connect()->prepare('
				INSERT INTO 
				products (name, price, description, image, categories_id, active) 
				VALUES (:name, :price, :description, :image, :categories_id, :productActive)');
			$stmt->execute(array(
				':name' => $name,
				':price' => $price,
				':description' => $description,
				':image' => $image,
				':categories_id' => $categories_id,
				':productActive' => $productActive
			));

			return true;
		} catch (Exception $e) {
			echo "<br>" . $e->getMessage();
			return false;
		}
	}

	public function updateProduct ($id, $name, $price, $description, $image, $categories_id, $productActive) {
		try {
			$stmt = parent::connect()->prepare('
				UPDATE products 
				SET name=:name, 
					price=:price, 
					description=:description, 
					image=:image, 
					categories_id=:categories_id, 
					active=:productActive
				WHERE id=:id');
				
			$stmt->execute(array(
				':name' => $name,
				':price' => $price,
				':description' => $description,
				':image' => $image,
				':categories_id' => $categories_id,
				':id' => $id,
				':productActive' => $productActive
			));

			return true;
		} catch (Exception $e) {
			echo "<br>" . $e->getMessage();
			return false;
		}
	}

	public function deleteProduct ($id) {
		try {
			$stmt = parent::connect()->prepare('
				UPDATE products 
				SET	active=:productActive
				WHERE id=:id');
			$active = 1;
			$stmt->execute(array(
				':productActive' => 1,
				'id' => $id
			));

			return true;
		} catch (Exception $e) {
			echo "<br>" . $e->getMessage();
			return false;
		}

	}

	public function activeProduct ($id) {
		try {
			$stmt = parent::connect()->prepare('
				UPDATE products 
				SET	active=:productActive
				WHERE id=:id');
			$stmt->execute(array(
				':productActive' => 0,
				'id' => $id
			));

			return true;
		} catch (Exception $e) {
			echo "<br>" . $e->getMessage();
			return false;
		}
	}

}