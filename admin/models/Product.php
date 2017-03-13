<?php
class Product extends Base_Model {
	function __construct () {

	}

	public function getAllData () {
		$pagination = new Pagination;
		$pagination->tblName = 'products';
		$pagination->current_page = isset($_GET['page']) ? $_GET['page'] : 1;
		$products = $pagination->listPages('products');
		$totalPages = $pagination->totalPages();
		return array(
			'data' => $products,
			'totalPages' => $totalPages
		);
	}

	public function getProduct ($id) {
		$stmt = parent::connect()->prepare('SELECT * FROM products WHERE id = :id');
		$stmt->execute(array(
			':id' => $id
		));
		return $data = $stmt->fetch(PDO::FETCH_ASSOC);

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
}