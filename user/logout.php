<?php
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Origin: *");
	
	include_once "../config/config.php";
	include_once "../object/logsesion.php";
	
	//koneksi ke database
	$database = new Database();
	$dbconnection = $database->getConnection();
	
	$logsesion = new LogSesion($dbconnection);
	$logsesion->_construct($dbconnection);
	
	$idactiveuser = $_GET["iduser"];
	
	$getlogdata = $logsesion->getlogsesion($idactiveuser);
	
	$getlogdata->bind_result($id,$id_user,$apikey,$is_active);
	
	$getlogdata->fetch();
	
	mysqli_close($dbconnection);
	
	$dbconnection = $database->getConnection();
	
	$logsesion = new LogSesion($dbconnection);
	$logsesion->_construct($dbconnection);
	
	$response = array();
	
	if($logsesion->logout($id)){
		$response['status'] = true;
		$response['message'] = "Logout berhasil";
		
		echo json_encode($response);
	}else{
		$response['status'] = false;
		$response['message'] = "Logout gagal";
		
		echo json_encode($response);
	}
?>