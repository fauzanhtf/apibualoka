<?php

class Database{
	
	private $host = "localhost";
	private $db_name = "bualoka";
	private $username = "root";
	private $password = "";
	
	public $connection;
	
	//untuk mendapatkan koneksi ke database
	public function getConnection(){
		$this->connection = null;
		
		$this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->db_name);
		
		/*try{
			$this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->connection->exec("set names utf8");
		
	
		}catch(PDOException $exception){
			echo "Connection Error : " . $exception->getMessage();
		}*/
		
		return $this->connection;
	}
}
?>