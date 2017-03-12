<?php
class Pagination {
    
	public $limit = LIMIT;
	public $current_page;
    public $totalPages;
    public $tblName;

	public function __construct() {
        
	}
         
    public function start() {
        $start = ($this->current_page - 1) * $this->limit;
        return $start;
    }

    public function totalRecords () {
        $sql = 'SELECT COUNT(id) AS total FROM ' . $this->tblName;
        $stmt = dbconnect::connect()->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $totalRecords = $data['total'];

        return $totalRecords;
    }

    public function totalPages() {
        $totalRecords = $this->totalRecords($this->tblName);
        $totalPages = ceil($totalRecords / $this->limit);
        return $totalPages;
    }

    public function listPages() {
        if ( $this->current_page > $this->totalPages() ) {
            $this->current_page = $this->totalPages();
        } else if ( $this->current_page < 1 ) {
            $this->current_page = 1;
        }
        $start = $this->start();

        $sql = 'SELECT * FROM ' . $this->tblName . ' ORDER BY created_at DESC LIMIT ' . $start . ', ' . $this->limit ;
        $stmt = dbconnect::connect()->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}