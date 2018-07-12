<?php
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Origin: *");
	
	include_once "../config/config.php";
	include_once "../object/user.php";

	$db = new Database();
	$connection = $db->getConnection();
	
	$user = new User();
	$user->_construct($connection);
	
	$user->email = $_POST["email"];
	$user->name = $_POST["name"];
	$user->password = password_hash($_POST["password"], PASSWORD_DEFAULT);
	$user->telp = $_POST["telp"];
	$user->address = $_POST["address"];
	$user->district = $_POST["district"];
	$user->city = $_POST["city"];
	$user->province = $_POST["province"];
	
	$user_registration = $user->register();
		
	$response = array();
		
	if($user_registration){
		$response['status'] = true;
		$response['message'] = "User berhasil dibuat";
		
		echo json_encode($response);
	} else {
		$response['status'] = false;
		$response['message'] = "User gagal dibuat";
		
		echo json_encode($response);
	}
?>