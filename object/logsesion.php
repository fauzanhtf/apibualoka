<?php

class LogSesion{
	
	//Inisialisasi koneksi database dan nama tabel
	public $connection;
	public $table_name = "logsesion";
	
	//Isi Object *sesuai dengan isi tabel di database
	public $id;
	public $id_user;
	public $apikey;
	public $is_active;
	
	//constructor
	public function _construct($db){
		$this->connection = $db;
	}
	
	public function setlogsesion(){
		$query = "insert into " .$this->table_name. " set id_user='".$this->id_user."', apikey='".$this->apikey."', is_active='".$this->is_active."'";
		
		$stmt = $this->connection->prepare($query);
		
		if($stmt->execute()){
			return true;
		} else {
			return false;
		}
	}
	
	public function getlogsesion($iduser){
		$query = "select * from " .$this->table_name. " where id_user = '".$iduser."' order by id desc limit 1";
		
		$stmt = $this->connection->prepare($query);
		
		$stmt->execute();
		
		return $stmt;
	}
	
	public function logout($idlogout){
		//echo $idlogout;
		$query = "update $this->table_name set is_active=0 where id=$idlogout";
		
		//echo $query;
		$stmt = $this->connection->prepare($query);
		
		if($stmt->execute()){
			return true;
		} else {
			return false;
		}
	}
}
?>