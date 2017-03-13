<?php
class Category extends Base_Model {
	function __construct () {
	}
	public function getAllCategoriesNoPagi () {
		$stmt = parent::connect()->prepare('SELECT name FROM categories');
		$stmt->execute();
		return $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
	public function addCategory ($name, $active) {
		try {
			$stmt = parent::connect()->prepare('
				INSERT INTO 
				categories (name, active) 
				VALUES (:name, :active)');
			$stmt->execute(array(
				':name' => $name,
				':active' => $active
			));

			return true;
		} catch (Exception $e) {
			echo "<br>" . $e->getMessage();
			return false;
		}
	}
	public function editCategory ($id, $name, $active) {
		try {
			$stmt = parent::connect()->prepare('
				UPDATE categories 
				SET name=:name,
					active=:active
				WHERE id=:id');
				
			$stmt->execute(array(
				':name' => $name,
				':active' => $active,
				':id' => $id,
			));
			return true;
		} catch (Exception $e) {
			echo "<br>" . $e->getMessage();
			return false;
		}
	}
}