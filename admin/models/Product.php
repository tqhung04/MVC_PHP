<?php
class Product extends Base_Model {
	function __construct () {
	}
	public function addProduct ($data) {
		try {
			$stmt = parent::connect()->prepare('
				INSERT INTO 
				products (name, price, description, image, categories_id, active) 
				VALUES (:name, :price, :description, :image, :categories_id, :productActive)');
			$stmt->execute(array(
				':name' => $data[0],
				':price' => $data[1],
				':description' => $data[2],
				':image' => $data[3],
				':categories_id' => $data[4],
				':productActive' => $data[5],
			));

			return true;
		} catch (Exception $e) {
			echo "<br>" . $e->getMessage();
			return false;
		}
	}
	public function updateProduct ($data) {
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
				':name' => $data[0],
				':price' => $data[1],
				':description' => $data[2],
				':image' => $data[3],
				':categories_id' => $data[4],
				':id' => $_GET['id'],
				':productActive' => $data[5],
			));

			return true;
		} catch (Exception $e) {
			echo "<br>" . $e->getMessage();
			return false;
		}
	}
}