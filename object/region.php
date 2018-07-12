<?php

class Region{
	
	//init koneksi ke database
	public $connection;
	public $table_name = "region";
	
	//column table object
	public $id;
	public $parent;
	public $name;
	public $level;
	
	//constructor class
	public function _construct($db){
		$this->connection = $db;
	}
	
	public function getRegion($parent){
		//$this->connection = $db;
		
		//querry select all from region
		$query = "SELECT * FROM " .$this->table_name. " WHERE parent = " .$parent;
		
		//prepare query statement
		$stmt = $this->connection->prepare($query);
		
		//execute query
		$stmt->execute();
		
		return $stmt;
		
	}
}

?>