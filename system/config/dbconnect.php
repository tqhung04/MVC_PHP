<?php
class dbconnect {
	public function connect () {
		// Connect Database
		try {
		    $conn = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . '', DB_USER, DB_PASSWORD);
		    $conn->exec("set names utf8");
		    return $conn;
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    die();
		}
	}
}