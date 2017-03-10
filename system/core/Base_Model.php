<?php
class Base_Model extends dbconnect {

	public function __construct () {

	}

	public function checkExist ($nameTbl, $nameField) {
		$sql = 'SELECT * FROM ' . $nameTbl . ' WHERE name = "' . $nameField . '"';
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

}