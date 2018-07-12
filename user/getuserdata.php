<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	include_once '../config/config.php';
	include_once '../object/user.php';

	//koneksi ke database
	$database = new Database();
	$dbconnection = $database->getConnection();
	
	//objek user
	$user = new User($dbconnection);

	$querry = $user->getUserData();
	$num = $querry->rowCount();

	if($num>0){
		$user_data = array(
			"id" => $id,
			"email" => $email,
			"name" => $name,
		);
	
		array_push($user_data);

		echo json_encode($user_data);
	}
	else{
		echo json_encode(
			array("message" => "user not found")
		);
	}
?>