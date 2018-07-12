<?php

class User{
	
	//Inisialisasi koneksi database dan nama tabel
	public $connection;
	public $table_name = "user";
	
	//Isi Object *sesuai dengan isi tabel di database
	public $id;
	public $email;
	public $name;
	public $password;
	public $telp;
	public $address;
	public $district;
	public $city;
	public $province;
	
	//constructor
	public function _construct($db){
		$this->connection = $db;
	}
	
	public function register(){
		$query = "insert into " .$this->table_name. " set email ='".$this->email."',name='".$this->name."', password='".$this->password."', address='".$this->address."', district='".$this->district."', city='".$this->city."', province='".$this->province."'";
		
		$stmt = $this->connection->prepare($query);
		
		if($stmt->execute()){
			return true;
		} else {
			return false;
		}
	}
	
	public function getdatauser(){
		$query = "select * from " .$this->table_name. " where email = '".$this->email."'";
		
		$stmt = $this->connection->prepare($query);
		
		$stmt->execute();
		
		return $stmt;
	}
}
?>